<?php
/**
 * Controller Mahasiswa
 * Menangani logika bisnis untuk manajemen data mahasiswa.
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Mahasiswa.php';
require_once __DIR__ . '/../core/Validator.php';
require_once __DIR__ . '/../helpers/flash.php';
require_once __DIR__ . '/../helpers/csrf.php';
require_once __DIR__ . '/../helpers/upload.php';

class MahasiswaController
{
    private $model;
    private $conn;

    public function __construct()
    {
        $this->conn = getConnection();
        $this->model = new Mahasiswa($this->conn);
    }

    /**
     * Ambil semua data mahasiswa untuk halaman index
     * @return array
     */
    public function index()
    {
        return [
            'mahasiswa' => $this->model->getAllOrdered(),
            'pageTitle' => 'Data Mahasiswa - SIAKAD Kampus'
        ];
    }

    /**
     * Proses penambahan mahasiswa baru
     * @param array $input Data dari form
     * @return array Result dengan success status dan message/errors
     */
    public function store($input, $file = null)
    {
        // Validasi CSRF
        if (!isset($input['csrf_token']) || !verifyCsrfToken($input['csrf_token'])) {
            return ['success' => false, 'errors' => ['Token keamanan tidak valid! Silakan muat ulang halaman.']];
        }

        // Validasi input
        $validator = new Validator($input);
        $validator
            ->required('nim', 'NIM wajib diisi!')
            ->required('nama', 'Nama wajib diisi!')
            ->required('prodi', 'Program Studi wajib diisi!')
            ->required('angkatan', 'Tahun Angkatan wajib diisi!')
            ->required('email', 'Email wajib diisi!')
            ->numeric('nim', 'NIM harus berupa angka!');

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->getErrors()];
        }

        // Cek duplikasi NIM
        if ($this->model->isNimExists($input['nim'])) {
            return ['success' => false, 'errors' => ['NIM sudah terdaftar di sistem!']];
        }

        // Handle upload foto jika ada
        $fotoFilename = null;
        if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
            $uploadResult = uploadImage($file, 'profile/mahasiswa');
            if ($uploadResult['error']) {
                return ['success' => false, 'errors' => [$uploadResult['error']]];
            }
            if ($uploadResult['success']) {
                $fotoFilename = $uploadResult['filename'];
            }
        }
        $input['foto'] = $fotoFilename;

        // Simpan data
        if ($this->model->create($input)) {
            regenerateCsrfToken();
            return ['success' => true, 'message' => 'Data mahasiswa berhasil ditambahkan!'];
        }

        // Jika gagal simpan dan ada foto, hapus foto yang sudah diupload
        if ($fotoFilename) {
            deleteImage($fotoFilename, 'profile/mahasiswa');
        }

        return ['success' => false, 'errors' => ['Gagal menyimpan data: ' . $this->model->getError()]];
    }

    /**
     * Ambil data mahasiswa untuk form edit
     * @param string $nim NIM mahasiswa
     * @return array|null
     */
    public function edit($nim)
    {
        return $this->model->getByNim($nim);
    }

    /**
     * Proses update data mahasiswa
     * @param string $nim NIM mahasiswa yang diupdate
     * @param array $input Data baru dari form
     * @return array Result dengan success status dan message/errors
     */
    public function update($nim, $input, $file = null)
    {
        // Validasi CSRF
        if (!isset($input['csrf_token']) || !verifyCsrfToken($input['csrf_token'])) {
            return ['success' => false, 'errors' => ['Token keamanan tidak valid! Silakan muat ulang halaman.']];
        }

        // Validasi input
        $validator = new Validator($input);
        $validator
            ->required('nama', 'Nama wajib diisi!')
            ->required('prodi', 'Program Studi wajib diisi!')
            ->required('angkatan', 'Tahun Angkatan wajib diisi!')
            ->required('email', 'Email wajib diisi!');

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->getErrors()];
        }

        // Handle upload foto jika ada file baru
        $fotoFilename = null;
        $oldFoto = null;
        if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
            $uploadResult = uploadImage($file, 'profile/mahasiswa');
            if ($uploadResult['error']) {
                return ['success' => false, 'errors' => [$uploadResult['error']]];
            }
            if ($uploadResult['success']) {
                $fotoFilename = $uploadResult['filename'];
                // Simpan nama foto lama untuk dihapus nanti
                $currentData = $this->model->getByNim($nim);
                $oldFoto = $currentData['foto'] ?? null;
            }
        }
        $input['foto'] = $fotoFilename;

        // Update data
        if ($this->model->update($nim, $input)) {
            // Hapus foto lama jika ada foto baru
            if ($fotoFilename && $oldFoto) {
                deleteImage($oldFoto, 'profile/mahasiswa');
            }
            regenerateCsrfToken();
            return ['success' => true, 'message' => 'Data mahasiswa berhasil diperbarui!'];
        }

        // Jika gagal update dan ada foto baru, hapus foto yang sudah diupload
        if ($fotoFilename) {
            deleteImage($fotoFilename, 'profile/mahasiswa');
        }

        return ['success' => false, 'errors' => ['Gagal memperbarui data: ' . $this->model->getError()]];
    }

    /**
     * Proses penghapusan mahasiswa
     * @param string $nim NIM mahasiswa yang dihapus
     * @return array Result dengan success status dan message/errors
     */
    public function destroy($nim)
    {
        if (empty($nim)) {
            return ['success' => false, 'errors' => ['NIM tidak valid!']];
        }

        if ($this->model->delete($nim)) {
            return ['success' => true, 'message' => 'Data mahasiswa berhasil dihapus.'];
        }

        // Cek error constraint
        $errorMsg = $this->model->getError();
        if (strpos($errorMsg, 'Constraint') !== false || strpos($errorMsg, 'foreign key') !== false) {
            return ['success' => false, 'errors' => ['Gagal menghapus! Mahasiswa ini masih memiliki data Nilai.']];
        }

        return ['success' => false, 'errors' => ['Gagal menghapus data: ' . $errorMsg]];
    }
}
