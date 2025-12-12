<?php
/**
 * Model Matkul (Mata Kuliah)
 * Menangani operasi database untuk tabel tbl_matkul.
 */

require_once __DIR__ . '/../core/Model.php';

class Matkul extends Model
{
    protected $table = 'tbl_matkul';

    /**
     * Cek apakah kode mata kuliah sudah ada
     * @param string $kodeMatkul Kode mata kuliah yang dicek
     * @return bool
     */
    public function isKodeExists($kodeMatkul)
    {
        return $this->exists('kodeMatkul', $kodeMatkul);
    }

    /**
     * Ambil mata kuliah berdasarkan kode
     * @param string $kodeMatkul Kode mata kuliah
     * @return array|null
     */
    public function getByKode($kodeMatkul)
    {
        return $this->getByColumn('kodeMatkul', $kodeMatkul);
    }

    /**
     * Simpan data mata kuliah baru
     * @param array $data Data mata kuliah (kodeMatkul, namaMatkul, sks, nidn)
     * @return bool
     */
    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (kodeMatkul, namaMatkul, sks, nidn) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $data['kodeMatkul'], $data['namaMatkul'], $data['sks'], $data['nidn']);
        return $stmt->execute();
    }

    /**
     * Update data mata kuliah
     * @param string $kodeMatkul Kode mata kuliah yang diupdate
     * @param array $data Data baru (namaMatkul, sks, nidn)
     * @return bool
     */
    public function update($kodeMatkul, $data)
    {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET namaMatkul = ?, sks = ?, nidn = ? WHERE kodeMatkul = ?");
        $stmt->bind_param("siss", $data['namaMatkul'], $data['sks'], $data['nidn'], $kodeMatkul);
        return $stmt->execute();
    }

    /**
     * Hapus mata kuliah berdasarkan kode
     * @param string $kodeMatkul Kode mata kuliah
     * @return bool
     */
    public function delete($kodeMatkul)
    {
        return $this->deleteByColumn('kodeMatkul', $kodeMatkul);
    }

    /**
     * Ambil semua mata kuliah dengan nama dosen
     * @return array
     */
    public function getAllWithDosen()
    {
        $query = "SELECT m.*, d.nama as nama_dosen 
                  FROM {$this->table} m 
                  LEFT JOIN tbl_dosen d ON m.nidn = d.nidn 
                  ORDER BY m.kodeMatkul ASC";
        $result = $this->conn->query($query);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Ambil NIDN dosen dari kode mata kuliah
     * @param string $kodeMatkul Kode mata kuliah
     * @return string|null
     */
    public function getNidnByKode($kodeMatkul)
    {
        $stmt = $this->conn->prepare("SELECT nidn FROM {$this->table} WHERE kodeMatkul = ?");
        $stmt->bind_param("s", $kodeMatkul);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ? $result['nidn'] : null;
    }
}
