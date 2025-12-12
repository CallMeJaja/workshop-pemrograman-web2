<?php
/**
 * Model Dosen
 * Menangani operasi database untuk tabel tbl_dosen.
 */

require_once __DIR__ . '/../core/Model.php';

class Dosen extends Model
{
    protected $table = 'tbl_dosen';

    /**
     * Cek apakah NIDN sudah ada
     * @param string $nidn NIDN yang dicek
     * @return bool
     */
    public function isNidnExists($nidn)
    {
        return $this->exists('nidn', $nidn);
    }

    /**
     * Ambil dosen berdasarkan NIDN
     * @param string $nidn NIDN dosen
     * @return array|null
     */
    public function getByNidn($nidn)
    {
        return $this->getByColumn('nidn', $nidn);
    }

    /**
     * Simpan data dosen baru
     * @param array $data Data dosen (nidn, nama, email)
     * @return bool
     */
    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (nidn, nama, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data['nidn'], $data['nama'], $data['email']);
        return $stmt->execute();
    }

    /**
     * Update data dosen
     * @param string $nidn NIDN dosen yang diupdate
     * @param array $data Data baru (nama, email)
     * @return bool
     */
    public function update($nidn, $data)
    {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET nama = ?, email = ? WHERE nidn = ?");
        $stmt->bind_param("sss", $data['nama'], $data['email'], $nidn);
        return $stmt->execute();
    }

    /**
     * Hapus dosen berdasarkan NIDN
     * @param string $nidn NIDN dosen
     * @return bool
     */
    public function delete($nidn)
    {
        return $this->deleteByColumn('nidn', $nidn);
    }

    /**
     * Ambil semua dosen urut berdasarkan NIDN
     * @return array
     */
    public function getAllOrdered()
    {
        return $this->getAll('nidn', 'ASC');
    }
}
