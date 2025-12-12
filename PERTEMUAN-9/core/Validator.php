<?php
/**
 * Validator Class
 * Validasi input terpusat untuk semua form.
 */

class Validator
{
    private $errors = [];
    private $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Validasi field wajib diisi
     * @param string $field Nama field
     * @param string $message Pesan error kustom
     * @return $this
     */
    public function required($field, $message = null)
    {
        if (!isset($this->data[$field]) || trim($this->data[$field]) === '') {
            $this->errors[$field] = $message ?? "Field {$field} wajib diisi!";
        }
        return $this;
    }

    /**
     * Validasi field harus berupa angka
     * @param string $field Nama field
     * @param string $message Pesan error kustom
     * @return $this
     */
    public function numeric($field, $message = null)
    {
        if (isset($this->data[$field]) && !empty($this->data[$field]) && !is_numeric($this->data[$field])) {
            $this->errors[$field] = $message ?? "Field {$field} harus berupa angka!";
        }
        return $this;
    }

    /**
     * Validasi format email
     * @param string $field Nama field
     * @param string $message Pesan error kustom
     * @return $this
     */
    public function email($field, $message = null)
    {
        if (isset($this->data[$field]) && !empty($this->data[$field]) && !filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = $message ?? "Format email tidak valid!";
        }
        return $this;
    }

    /**
     * Validasi nilai minimum
     * @param string $field Nama field
     * @param int|float $min Nilai minimum
     * @param string $message Pesan error kustom
     * @return $this
     */
    public function min($field, $min, $message = null)
    {
        if (isset($this->data[$field]) && is_numeric($this->data[$field]) && $this->data[$field] < $min) {
            $this->errors[$field] = $message ?? "Field {$field} minimal bernilai {$min}!";
        }
        return $this;
    }

    /**
     * Validasi nilai maksimum
     * @param string $field Nama field
     * @param int|float $max Nilai maksimum
     * @param string $message Pesan error kustom
     * @return $this
     */
    public function max($field, $max, $message = null)
    {
        if (isset($this->data[$field]) && is_numeric($this->data[$field]) && $this->data[$field] > $max) {
            $this->errors[$field] = $message ?? "Field {$field} maksimal bernilai {$max}!";
        }
        return $this;
    }

    /**
     * Cek apakah validasi berhasil (tidak ada error)
     * @return bool
     */
    public function passes()
    {
        return empty($this->errors);
    }

    /**
     * Cek apakah validasi gagal
     * @return bool
     */
    public function fails()
    {
        return !empty($this->errors);
    }

    /**
     * Ambil semua error
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Ambil error pertama
     * @return string|null
     */
    public function getFirstError()
    {
        return !empty($this->errors) ? reset($this->errors) : null;
    }

    /**
     * Ambil semua error sebagai string
     * @param string $separator Pemisah antar error
     * @return string
     */
    public function getErrorsAsString($separator = '<br>')
    {
        return implode($separator, $this->errors);
    }
}
