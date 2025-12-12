<?php
/**
 * Model Nilai
 * Menangani operasi database untuk tabel tbl_nilai.
 */

require_once __DIR__ . '/../core/Model.php';

class Nilai extends Model
{
    protected $table = 'tbl_nilai';

    /**
     * Ambil nilai berdasarkan ID
     * @param int $id ID nilai
     * @return array|null
     */
    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id_nilai = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Simpan data nilai baru
     * @param array $data Data nilai (nim, kodeMatkul, nidn, nilai, nilaiHuruf)
     * @return bool
     */
    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (nim, kodeMatkul, nidn, nilai, nilaiHuruf) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssds", $data['nim'], $data['kodeMatkul'], $data['nidn'], $data['nilai'], $data['nilaiHuruf']);
        return $stmt->execute();
    }

    /**
     * Update data nilai
     * @param int $id ID nilai yang diupdate
     * @param array $data Data baru (nim, kodeMatkul, nidn, nilai, nilaiHuruf)
     * @return bool
     */
    public function update($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET nim = ?, kodeMatkul = ?, nidn = ?, nilai = ?, nilaiHuruf = ? WHERE id_nilai = ?");
        $stmt->bind_param("sssdsi", $data['nim'], $data['kodeMatkul'], $data['nidn'], $data['nilai'], $data['nilaiHuruf'], $id);
        return $stmt->execute();
    }

    /**
     * Hapus nilai berdasarkan ID
     * @param int $id ID nilai
     * @return bool
     */
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id_nilai = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    /**
     * Ambil semua nilai dengan relasi mahasiswa, matkul, dan dosen
     * @return array
     */
    public function getAllWithRelations()
    {
        $query = "SELECT 
                    n.id_nilai,
                    n.nilai,
                    n.nilaiHuruf,
                    m.nim,
                    m.nama as nama_mahasiswa,
                    mk.kodeMatkul,
                    mk.namaMatkul,
                    mk.sks,
                    d.nidn,
                    d.nama as nama_dosen
                  FROM {$this->table} n
                  LEFT JOIN tbl_mahasiswa m ON n.nim = m.nim
                  LEFT JOIN tbl_matkul mk ON n.kodeMatkul = mk.kodeMatkul
                  LEFT JOIN tbl_dosen d ON n.nidn = d.nidn
                  ORDER BY n.id_nilai ASC";
        $result = $this->conn->query($query);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Konversi nilai angka ke huruf
     * @param float $nilai Nilai angka
     * @return string Nilai huruf
     */
    public static function convertToGrade($nilai)
    {
        if ($nilai >= 85) return 'A';
        if ($nilai >= 75) return 'B';
        if ($nilai >= 60) return 'C';
        if ($nilai >= 50) return 'D';
        return 'E';
    }
}
