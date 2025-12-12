<?php
/**
 * Model Mahasiswa
 * Menangani operasi database untuk tabel tbl_mahasiswa.
 */

require_once __DIR__ . '/../core/Model.php';

class Mahasiswa extends Model
{
    protected $table = 'tbl_mahasiswa';

    /**
     * Cek apakah NIM sudah ada
     * @param string $nim NIM yang dicek
     * @return bool
     */
    public function isNimExists($nim)
    {
        return $this->exists('nim', $nim);
    }

    /**
     * Ambil mahasiswa berdasarkan NIM
     * @param string $nim NIM mahasiswa
     * @return array|null
     */
    public function getByNim($nim)
    {
        return $this->getByColumn('nim', $nim);
    }

    /**
     * Simpan data mahasiswa baru
     * @param array $data Data mahasiswa (nim, nama, prodi, angkatan, email)
     * @return bool
     */
    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (nim, nama, prodi, angkatan, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['nim'], $data['nama'], $data['prodi'], $data['angkatan'], $data['email']);
        return $stmt->execute();
    }

    /**
     * Update data mahasiswa
     * @param string $nim NIM mahasiswa yang diupdate
     * @param array $data Data baru (nama, prodi, angkatan, email)
     * @return bool
     */
    public function update($nim, $data)
    {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET nama = ?, prodi = ?, angkatan = ?, email = ? WHERE nim = ?");
        $stmt->bind_param("sssss", $data['nama'], $data['prodi'], $data['angkatan'], $data['email'], $nim);
        return $stmt->execute();
    }

    /**
     * Hapus mahasiswa berdasarkan NIM
     * @param string $nim NIM mahasiswa
     * @return bool
     */
    public function delete($nim)
    {
        return $this->deleteByColumn('nim', $nim);
    }

    /**
     * Ambil semua mahasiswa urut berdasarkan NIM
     * @return array
     */
    public function getAllOrdered()
    {
        return $this->getAll('nim', 'ASC');
    }
}
