<?php
/**
 * Base Model Class
 * Menyediakan fungsionalitas dasar untuk semua model.
 */

class Model
{
    protected $conn;
    protected $table;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Ambil semua data dari tabel
     * @param string $orderBy Kolom untuk pengurutan
     * @param string $order ASC atau DESC
     * @return array
     */
    public function getAll($orderBy = null, $order = 'ASC')
    {
        $sql = "SELECT * FROM {$this->table}";
        if ($orderBy) {
            $sql .= " ORDER BY {$orderBy} {$order}";
        }
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Ambil data berdasarkan primary key
     * @param string $column Nama kolom primary key
     * @param mixed $value Nilai primary key
     * @return array|null
     */
    public function getByColumn($column, $value)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE {$column} = ?");
        $stmt->bind_param("s", $value);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Cek apakah nilai sudah ada di kolom tertentu
     * @param string $column Nama kolom
     * @param mixed $value Nilai yang dicek
     * @return bool
     */
    public function exists($column, $value)
    {
        $stmt = $this->conn->prepare("SELECT {$column} FROM {$this->table} WHERE {$column} = ?");
        $stmt->bind_param("s", $value);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    /**
     * Hapus data berdasarkan kolom
     * @param string $column Nama kolom
     * @param mixed $value Nilai kolom
     * @return bool
     */
    public function deleteByColumn($column, $value)
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE {$column} = ?");
        $stmt->bind_param("s", $value);
        return $stmt->execute();
    }

    /**
     * Mendapatkan pesan error terakhir dari koneksi
     * @return string
     */
    public function getError()
    {
        return $this->conn->error;
    }
}
