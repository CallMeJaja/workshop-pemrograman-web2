<?php
/**
 * Upload Helper
 * Menangani upload file gambar dengan validasi keamanan
 * 
 * Fitur:
 * - Validasi tipe MIME dan ekstensi file
 * - Validasi ukuran file (max 2MB)
 * - Generate nama file unik mencegah overwrite
 * - Penghapusan file lama saat update
 */

// Konfigurasi upload
define('UPLOAD_MAX_SIZE', 2 * 1024 * 1024); // 2MB dalam bytes
define('UPLOAD_BASE_DIR', __DIR__ . '/../upload/');
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'webp']);
define('ALLOWED_MIME_TYPES', [
    'image/jpeg',
    'image/png', 
    'image/gif',
    'image/webp'
]);

/**
 * Upload file gambar profil
 * 
 * @param array $file Data dari $_FILES['field_name']
 * @param string $subfolder Subfolder tujuan (contoh: 'profile')
 * @return array ['success' => bool, 'filename' => string|null, 'error' => string|null]
 */
function uploadImage($file, $subfolder = 'profile')
{
    // Cek apakah ada file yang diupload
    if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return ['success' => false, 'filename' => null, 'error' => null]; // Tidak ada file, bukan error
    }

    // Cek error upload PHP
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return [
            'success' => false,
            'filename' => null,
            'error' => getUploadErrorMessage($file['error'])
        ];
    }

    // Validasi ukuran file
    if ($file['size'] > UPLOAD_MAX_SIZE) {
        $maxMB = UPLOAD_MAX_SIZE / (1024 * 1024);
        return [
            'success' => false,
            'filename' => null,
            'error' => "Ukuran file terlalu besar! Maksimal {$maxMB}MB."
        ];
    }

    // Validasi ekstensi file
    $originalName = $file['name'];
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    
    if (!in_array($extension, ALLOWED_EXTENSIONS)) {
        $allowed = implode(', ', ALLOWED_EXTENSIONS);
        return [
            'success' => false,
            'filename' => null,
            'error' => "Tipe file tidak diizinkan! Format yang diperbolehkan: {$allowed}."
        ];
    }

    // Validasi MIME type (cek konten file sebenarnya)
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);
    
    if (!in_array($mimeType, ALLOWED_MIME_TYPES)) {
        return [
            'success' => false,
            'filename' => null,
            'error' => 'File bukan gambar yang valid atau rusak!'
        ];
    }

    // Buat direktori tujuan jika belum ada
    $uploadDir = UPLOAD_BASE_DIR . $subfolder . '/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            return [
                'success' => false,
                'filename' => null,
                'error' => 'Gagal membuat direktori upload!'
            ];
        }
    }

    // Generate nama file unik
    $uniqueName = generateUniqueFilename($extension);
    $destination = $uploadDir . $uniqueName;

    // Pindahkan file
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return [
            'success' => true,
            'filename' => $uniqueName,
            'error' => null
        ];
    }

    return [
        'success' => false,
        'filename' => null,
        'error' => 'Gagal menyimpan file! Periksa permission folder.'
    ];
}

/**
 * Hapus file gambar dari folder upload
 * 
 * @param string $filename Nama file yang akan dihapus
 * @param string $subfolder Subfolder tempat file berada
 * @return bool True jika berhasil atau file tidak ada
 */
function deleteImage($filename, $subfolder = 'profile')
{
    if (empty($filename)) {
        return true;
    }

    $filepath = UPLOAD_BASE_DIR . $subfolder . '/' . $filename;
    
    if (file_exists($filepath)) {
        return unlink($filepath);
    }

    return true; // File tidak ada, anggap sukses
}

/**
 * Generate nama file unik berdasarkan timestamp dan random string
 * 
 * @param string $extension Ekstensi file
 * @return string Nama file unik
 */
function generateUniqueFilename($extension)
{
    $timestamp = date('Ymd_His');
    $random = bin2hex(random_bytes(8)); // 16 karakter hex
    return "img_{$timestamp}_{$random}.{$extension}";
}

/**
 * Dapatkan pesan error berdasarkan kode error PHP upload
 * 
 * @param int $errorCode Kode error dari $_FILES['field']['error']
 * @return string Pesan error dalam Bahasa Indonesia
 */
function getUploadErrorMessage($errorCode)
{
    $messages = [
        UPLOAD_ERR_INI_SIZE   => 'Ukuran file melebihi batas yang diizinkan server.',
        UPLOAD_ERR_FORM_SIZE  => 'Ukuran file melebihi batas yang ditentukan form.',
        UPLOAD_ERR_PARTIAL    => 'File hanya terupload sebagian. Coba lagi.',
        UPLOAD_ERR_NO_FILE    => 'Tidak ada file yang diupload.',
        UPLOAD_ERR_NO_TMP_DIR => 'Folder temporary tidak ditemukan di server.',
        UPLOAD_ERR_CANT_WRITE => 'Gagal menulis file ke disk.',
        UPLOAD_ERR_EXTENSION  => 'Upload dibatalkan oleh ekstensi PHP.',
    ];

    return $messages[$errorCode] ?? 'Error tidak diketahui saat upload file.';
}

/**
 * Dapatkan URL gambar untuk ditampilkan
 * 
 * @param string $filename Nama file gambar
 * @param string $subfolder Subfolder tempat file berada
 * @return string URL relatif ke gambar atau placeholder jika tidak ada
 */
function getImageUrl($filename, $subfolder = 'profile')
{
    if (empty($filename)) {
        // Return placeholder icon atau gambar default
        return null;
    }
    
    // Return path relatif dari root project
    return "../../upload/{$subfolder}/{$filename}";
}

/**
 * Cek apakah file gambar ada
 * 
 * @param string $filename Nama file gambar
 * @param string $subfolder Subfolder tempat file berada
 * @return bool
 */
function imageExists($filename, $subfolder = 'profile')
{
    if (empty($filename)) {
        return false;
    }
    
    $filepath = UPLOAD_BASE_DIR . $subfolder . '/' . $filename;
    return file_exists($filepath);
}
