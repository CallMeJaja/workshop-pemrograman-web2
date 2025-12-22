<?php
/**
 * Controller Dosen
 * Menangani logika bisnis untuk manajemen data dosen.
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Dosen.php';
require_once __DIR__ . '/../core/Validator.php';
require_once __DIR__ . '/../helpers/flash.php';
require_once __DIR__ . '/../helpers/csrf.php';
require_once __DIR__ . '/../helpers/upload.php';

class DosenController
{
    private $model;
    private $conn;

    public function __construct()
    {
        $this->conn = getConnection();
        $this->model = new Dosen($this->conn);
    }

    /**
     * Ambil semua data dosen untuk halaman index
     * @return array
     */
    public function index()
    {
        return [
            'dosen' => $this->model->getAllOrdered(),
            'pageTitle' => 'Data Dosen - SIAKAD Kampus'
        ];
    }

    /**
     * Proses penambahan dosen baru
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
            ->required('nidn', 'NIDN wajib diisi!')
            ->required('nama', 'Nama wajib diisi!')
            ->required('email', 'Email wajib diisi!')
            ->numeric('nidn', 'NIDN harus berupa angka!')
            ->email('email', 'Format email tidak valid!');

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->getErrors()];
        }

        // Cek duplikasi NIDN
        if ($this->model->isNidnExists($input['nidn'])) {
            return ['success' => false, 'errors' => ['NIDN sudah terdaftar di sistem!']];
        }

        // Handle upload foto jika ada
        $fotoFilename = null;
        if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
            $uploadResult = uploadImage($file, 'profile/dosen');
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
            return ['success' => true, 'message' => 'Data dosen berhasil ditambahkan!'];
        }

        // Jika gagal simpan dan ada foto, hapus foto yang sudah diupload
        if ($fotoFilename) {
            deleteImage($fotoFilename, 'profile/dosen');
        }

        return ['success' => false, 'errors' => ['Gagal menyimpan data: ' . $this->model->getError()]];
    }

    /**
     * Ambil data dosen untuk form edit
     * @param string $nidn NIDN dosen
     * @return array|null
     */
    public function edit($nidn)
    {
        return $this->model->getByNidn($nidn);
    }

    /**
     * Proses update data dosen
     * @param string $nidn NIDN dosen yang diupdate
     * @param array $input Data baru dari form
     * @return array Result dengan success status dan message/errors
     */
    public function update($nidn, $input, $file = null)
    {
        // Validasi CSRF
        if (!isset($input['csrf_token']) || !verifyCsrfToken($input['csrf_token'])) {
            return ['success' => false, 'errors' => ['Token keamanan tidak valid! Silakan muat ulang halaman.']];
        }

        // Validasi input
        $validator = new Validator($input);
        $validator
            ->required('nama', 'Nama wajib diisi!')
            ->required('email', 'Email wajib diisi!')
            ->email('email', 'Format email tidak valid!');

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->getErrors()];
        }

        // Handle upload foto jika ada file baru
        $fotoFilename = null;
        $oldFoto = null;
        if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
            $uploadResult = uploadImage($file, 'profile/dosen');
            if ($uploadResult['error']) {
                return ['success' => false, 'errors' => [$uploadResult['error']]];
            }
            if ($uploadResult['success']) {
                $fotoFilename = $uploadResult['filename'];
                // Simpan nama foto lama untuk dihapus nanti
                $currentData = $this->model->getByNidn($nidn);
                $oldFoto = $currentData['foto'] ?? null;
            }
        }
        $input['foto'] = $fotoFilename;

        // Update data
        if ($this->model->update($nidn, $input)) {
            // Hapus foto lama jika ada foto baru
            if ($fotoFilename && $oldFoto) {
                deleteImage($oldFoto, 'profile/dosen');
            }
            regenerateCsrfToken();
            return ['success' => true, 'message' => 'Data dosen berhasil diperbarui!'];
        }

        // Jika gagal update dan ada foto baru, hapus foto yang sudah diupload
        if ($fotoFilename) {
            deleteImage($fotoFilename, 'profile/dosen');
        }

        return ['success' => false, 'errors' => ['Gagal memperbarui data: ' . $this->model->getError()]];
    }

    /**
     * Proses penghapusan dosen
     * @param string $nidn NIDN dosen yang dihapus
     * @return array Result dengan success status dan message/errors
     */
    public function destroy($nidn)
    {
        if (empty($nidn)) {
            return ['success' => false, 'errors' => ['NIDN tidak valid!']];
        }

        if ($this->model->delete($nidn)) {
            return ['success' => true, 'message' => 'Data dosen berhasil dihapus.'];
        }

        // Cek error constraint
        $errorMsg = $this->model->getError();
        if (strpos($errorMsg, 'Constraint') !== false || strpos($errorMsg, 'foreign key') !== false) {
            return ['success' => false, 'errors' => ['Gagal menghapus! Dosen ini masih menjadi pengampu mata kuliah atau wali.']];
        }

        return ['success' => false, 'errors' => ['Gagal menghapus data: ' . $errorMsg]];
    }
}
