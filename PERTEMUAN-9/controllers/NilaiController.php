<?php
/**
 * Controller Nilai
 * Menangani logika bisnis untuk manajemen data nilai.
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Nilai.php';
require_once __DIR__ . '/../models/Mahasiswa.php';
require_once __DIR__ . '/../models/Matkul.php';
require_once __DIR__ . '/../models/Dosen.php';
require_once __DIR__ . '/../core/Validator.php';
require_once __DIR__ . '/../helpers/flash.php';
require_once __DIR__ . '/../helpers/csrf.php';

class NilaiController
{
    private $model;
    private $mahasiswaModel;
    private $matkulModel;
    private $dosenModel;
    private $conn;

    public function __construct()
    {
        $this->conn = getConnection();
        $this->model = new Nilai($this->conn);
        $this->mahasiswaModel = new Mahasiswa($this->conn);
        $this->matkulModel = new Matkul($this->conn);
        $this->dosenModel = new Dosen($this->conn);
    }

    /**
     * Ambil semua data nilai untuk halaman index
     * @return array
     */
    public function index()
    {
        return [
            'nilai' => $this->model->getAllWithRelations(),
            'pageTitle' => 'Data Nilai - SIAKAD Kampus'
        ];
    }

    /**
     * Ambil data untuk form tambah
     * @return array
     */
    public function create()
    {
        return [
            'mahasiswa' => $this->mahasiswaModel->getAllOrdered(),
            'matkul' => $this->matkulModel->getAll('namaMatkul', 'ASC'),
            'pageTitle' => 'Input Nilai - SIAKAD Kampus'
        ];
    }

    /**
     * Proses penambahan nilai baru
     * @param array $input Data dari form
     * @return array Result dengan success status dan message/errors
     */
    public function store($input)
    {
        // Validasi CSRF
        if (!isset($input['csrf_token']) || !verifyCsrfToken($input['csrf_token'])) {
            return ['success' => false, 'errors' => ['Token keamanan tidak valid! Silakan muat ulang halaman.']];
        }

        // Ambil NIDN dari mata kuliah yang dipilih
        $nidn = null;
        if (!empty($input['kodeMatkul'])) {
            $nidn = $this->matkulModel->getNidnByKode($input['kodeMatkul']);
        }
        $input['nidn'] = $nidn;

        // Validasi input
        $validator = new Validator($input);
        $validator
            ->required('nim', 'Mahasiswa wajib dipilih!')
            ->required('kodeMatkul', 'Mata Kuliah wajib dipilih!')
            ->required('nilai', 'Nilai wajib diisi!')
            ->numeric('nilai', 'Nilai harus berupa angka!')
            ->min('nilai', 0, 'Nilai minimal 0!')
            ->max('nilai', 100, 'Nilai maksimal 100!');

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->getErrors()];
        }

        if (empty($nidn)) {
            return ['success' => false, 'errors' => ['Mata Kuliah tidak memiliki Dosen Pengampu!']];
        }

        // Konversi nilai ke huruf
        $input['nilaiHuruf'] = Nilai::convertToGrade($input['nilai']);

        // Simpan data
        if ($this->model->create($input)) {
            regenerateCsrfToken();
            return ['success' => true, 'message' => 'Nilai berhasil disimpan!'];
        }

        return ['success' => false, 'errors' => ['Gagal menyimpan data: ' . $this->model->getError()]];
    }

    /**
     * Ambil data nilai untuk form edit
     * @param int $id ID nilai
     * @return array|null
     */
    public function edit($id)
    {
        $nilai = $this->model->getById($id);
        if ($nilai) {
            return [
                'nilai' => $nilai,
                'mahasiswa' => $this->mahasiswaModel->getAllOrdered(),
                'matkul' => $this->matkulModel->getAll('namaMatkul', 'ASC'),
                'dosen' => $this->dosenModel->getAllOrdered(),
                'pageTitle' => 'Edit Nilai - SIAKAD Kampus'
            ];
        }
        return null;
    }

    /**
     * Proses update data nilai
     * @param int $id ID nilai yang diupdate
     * @param array $input Data baru dari form
     * @return array Result dengan success status dan message/errors
     */
    public function update($id, $input)
    {
        // Validasi CSRF
        if (!isset($input['csrf_token']) || !verifyCsrfToken($input['csrf_token'])) {
            return ['success' => false, 'errors' => ['Token keamanan tidak valid! Silakan muat ulang halaman.']];
        }

        // Ambil NIDN dari mata kuliah jika tidak disediakan
        if (empty($input['nidn']) && !empty($input['kodeMatkul'])) {
            $input['nidn'] = $this->matkulModel->getNidnByKode($input['kodeMatkul']);
        }

        // Validasi input
        $validator = new Validator($input);
        $validator
            ->required('nim', 'Mahasiswa wajib dipilih!')
            ->required('kodeMatkul', 'Mata Kuliah wajib dipilih!')
            ->required('nidn', 'Dosen Pengampu wajib ada!')
            ->required('nilai', 'Nilai wajib diisi!')
            ->numeric('nilai', 'Nilai harus berupa angka!')
            ->min('nilai', 0, 'Nilai minimal 0!')
            ->max('nilai', 100, 'Nilai maksimal 100!');

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->getErrors()];
        }

        // Konversi nilai ke huruf
        $input['nilaiHuruf'] = Nilai::convertToGrade($input['nilai']);

        // Update data
        if ($this->model->update($id, $input)) {
            regenerateCsrfToken();
            return ['success' => true, 'message' => 'Data nilai berhasil diperbarui!'];
        }

        return ['success' => false, 'errors' => ['Gagal memperbarui data: ' . $this->model->getError()]];
    }

    /**
     * Proses penghapusan nilai
     * @param int $id ID nilai yang dihapus
     * @return array Result dengan success status dan message/errors
     */
    public function destroy($id)
    {
        if (empty($id)) {
            return ['success' => false, 'errors' => ['ID Nilai tidak valid!']];
        }

        if ($this->model->delete($id)) {
            return ['success' => true, 'message' => 'Data nilai berhasil dihapus.'];
        }

        return ['success' => false, 'errors' => ['Gagal menghapus data: ' . $this->model->getError()]];
    }

    /**
     * Mendapatkan warna badge berdasarkan grade
     * @param string $grade Nilai huruf
     * @return string CSS class
     */
    public static function getGradeColor($grade)
    {
        switch ($grade) {
            case 'A': return 'bg-success';
            case 'B': return 'bg-primary';
            case 'C': return 'bg-warning text-dark';
            case 'D': return 'bg-danger';
            case 'E': return 'bg-dark';
            default: return 'bg-secondary';
        }
    }
}
