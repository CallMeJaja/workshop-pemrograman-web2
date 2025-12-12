<?php
/**
 * Controller Matkul (Mata Kuliah)
 * Menangani logika bisnis untuk manajemen data mata kuliah.
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Matkul.php';
require_once __DIR__ . '/../models/Dosen.php';
require_once __DIR__ . '/../core/Validator.php';
require_once __DIR__ . '/../helpers/flash.php';
require_once __DIR__ . '/../helpers/csrf.php';

class MatkulController
{
    private $model;
    private $dosenModel;
    private $conn;

    public function __construct()
    {
        $this->conn = getConnection();
        $this->model = new Matkul($this->conn);
        $this->dosenModel = new Dosen($this->conn);
    }

    /**
     * Ambil semua data mata kuliah untuk halaman index
     * @return array
     */
    public function index()
    {
        return [
            'matkul' => $this->model->getAllWithDosen(),
            'pageTitle' => 'Data Mata Kuliah - SIAKAD Kampus'
        ];
    }

    /**
     * Ambil data untuk form tambah (termasuk daftar dosen)
     * @return array
     */
    public function create()
    {
        return [
            'dosen' => $this->dosenModel->getAllOrdered(),
            'pageTitle' => 'Tambah Mata Kuliah - SIAKAD Kampus'
        ];
    }

    /**
     * Proses penambahan mata kuliah baru
     * @param array $input Data dari form
     * @return array Result dengan success status dan message/errors
     */
    public function store($input)
    {
        // Validasi CSRF
        if (!isset($input['csrf_token']) || !verifyCsrfToken($input['csrf_token'])) {
            return ['success' => false, 'errors' => ['Token keamanan tidak valid! Silakan muat ulang halaman.']];
        }

        // Validasi input
        $validator = new Validator($input);
        $validator
            ->required('kodeMatkul', 'Kode Mata Kuliah wajib diisi!')
            ->required('namaMatkul', 'Nama Mata Kuliah wajib diisi!')
            ->required('sks', 'SKS wajib diisi!')
            ->required('nidn', 'Dosen Pengampu wajib dipilih!')
            ->numeric('sks', 'SKS harus berupa angka!');

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->getErrors()];
        }

        // Cek duplikasi kode
        if ($this->model->isKodeExists($input['kodeMatkul'])) {
            return ['success' => false, 'errors' => ['Kode Mata Kuliah sudah terdaftar di sistem!']];
        }

        // Simpan data
        if ($this->model->create($input)) {
            regenerateCsrfToken();
            return ['success' => true, 'message' => 'Mata kuliah berhasil ditambahkan!'];
        }

        return ['success' => false, 'errors' => ['Gagal menyimpan data: ' . $this->model->getError()]];
    }

    /**
     * Ambil data mata kuliah untuk form edit
     * @param string $kodeMatkul Kode mata kuliah
     * @return array|null
     */
    public function edit($kodeMatkul)
    {
        $matkul = $this->model->getByKode($kodeMatkul);
        if ($matkul) {
            return [
                'matkul' => $matkul,
                'dosen' => $this->dosenModel->getAllOrdered(),
                'pageTitle' => 'Edit Mata Kuliah - SIAKAD Kampus'
            ];
        }
        return null;
    }

    /**
     * Proses update data mata kuliah
     * @param string $kodeMatkul Kode mata kuliah yang diupdate
     * @param array $input Data baru dari form
     * @return array Result dengan success status dan message/errors
     */
    public function update($kodeMatkul, $input)
    {
        // Validasi CSRF
        if (!isset($input['csrf_token']) || !verifyCsrfToken($input['csrf_token'])) {
            return ['success' => false, 'errors' => ['Token keamanan tidak valid! Silakan muat ulang halaman.']];
        }

        // Validasi input
        $validator = new Validator($input);
        $validator
            ->required('namaMatkul', 'Nama Mata Kuliah wajib diisi!')
            ->required('sks', 'SKS wajib diisi!')
            ->required('nidn', 'Dosen Pengampu wajib dipilih!')
            ->numeric('sks', 'SKS harus berupa angka!');

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->getErrors()];
        }

        // Update data
        if ($this->model->update($kodeMatkul, $input)) {
            regenerateCsrfToken();
            return ['success' => true, 'message' => 'Data mata kuliah berhasil diperbarui!'];
        }

        return ['success' => false, 'errors' => ['Gagal memperbarui data: ' . $this->model->getError()]];
    }

    /**
     * Proses penghapusan mata kuliah
     * @param string $kodeMatkul Kode mata kuliah yang dihapus
     * @return array Result dengan success status dan message/errors
     */
    public function destroy($kodeMatkul)
    {
        if (empty($kodeMatkul)) {
            return ['success' => false, 'errors' => ['Kode MK tidak valid!']];
        }

        if ($this->model->delete($kodeMatkul)) {
            return ['success' => true, 'message' => 'Data mata kuliah berhasil dihapus.'];
        }

        // Cek error constraint
        $errorMsg = $this->model->getError();
        if (strpos($errorMsg, 'Constraint') !== false || strpos($errorMsg, 'foreign key') !== false) {
            return ['success' => false, 'errors' => ['Gagal menghapus! Mata kuliah ini masih memiliki data Nilai.']];
        }

        return ['success' => false, 'errors' => ['Gagal menghapus data: ' . $errorMsg]];
    }
}
