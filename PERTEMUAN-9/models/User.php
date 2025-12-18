<?php
require_once __DIR__ . '/../config/database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = getConnection();
    }

    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbl_user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbl_user WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getAll()
    {
        $result = $this->db->query("SELECT id, username, role FROM tbl_user ORDER BY id ASC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function login($username, $password)
    {
        $user = $this->findByUsername($username);

        // Cek user ada dan password cocok (plain text)
        if ($user && $user['password'] === $password) {
            return $user;
        }

        return false;
    }
}
