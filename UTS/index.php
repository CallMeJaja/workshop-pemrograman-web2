<?php
$anggota = [
    "Reza Asriano Maulana",
    "Satrio Ilham Syahputra",
    "Dhafi Ebsan Yurizal",
    "Helgi Nur Allamsyah",
    "Fikri Ramdani"
];

$posisi = [
    'Lead Developer' => [
        'upah_per_jam' => 450000,
        'persen_lembur' => 18,
        'persen_fee' => 5
    ],
    'QA Engineer' => [
        'upah_per_jam' => 250000,
        'persen_lembur' => 12,
        'persen_fee' => 1
    ],
    'DevOps Engineer' => [
        'upah_per_jam' => 350000,
        'persen_lembur' => 10,
        'persen_fee' => 2.5
    ],
    'Backend Dev' => [
        'upah_per_jam' => 300000,
        'persen_lembur' => 15,
        'persen_fee' => 3
    ],
    'Frontend Dev' => [
        'upah_per_jam' => 300000,
        'persen_lembur' => 15,
        'persen_fee' => 3
    ]
];

function hitungUpahJamKerja($jam_kerja, $upah_per_jam)
{
    return hitungJamLembur($jam_kerja) > 0
        ? 160 * $upah_per_jam
        : $jam_kerja * $upah_per_jam;
}

function hitungUpahLembur($jam_kerja, $upah_per_jam, $persen_lembur)
{
    $jam_lembur = hitungJamLembur($jam_kerja);
    if ($jam_lembur > 0) {
        $upah_lembur_per_jam = $upah_per_jam * ($persen_lembur / 100);
        return $jam_lembur * $upah_lembur_per_jam;
    } else {
        return 0;
    }
}

function hitungJamLembur($jam_kerja)
{
    if ($jam_kerja > 160) {
        return $jam_kerja - 160;
    } else {
        return 0;
    }
}

function hitungUpahFee($harga_project, $persen_fee)
{
    return $harga_project * ($persen_fee / 100);
}

function hitungTotalUpah($upah_jam_kerja, $upah_lembur, $upah_fee)
{
    return $upah_jam_kerja + $upah_lembur + $upah_fee;
}

?>

<form action="#" method="POST">
    <label for="nama">Nama:</label>
    <select name="anggota" id="">
        <option value="">Pilih Anggota</option>
        <?php foreach ($anggota as $a) : ?>
            <option value="<?= $a ?>"><?= $a ?></option>
        <?php endforeach; ?>
    </select> <br>
    <label for="role">Posisi:</label>
    <select name="role" id="role">
        <option value="">Pilih Posisi</option>
        <?php foreach ($posisi as $p => $details) : ?>
            <option value="<?= $p ?>"><?= $p ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="jam_kerja">Jam Kerja:</label>
    <input type="number" name="jam_kerja" id="jam_kerja" required min="1">
    <br>
    <label for="harga_project">Harga Project:</label>
    <input type="number" name="harga_project" id="harga_project" required min="1">
    <br>
    <input type="submit" value="Hitung Gaji" name="submit">
    <input type="reset" value="Reset" name="reset">
</form>

<?php
if (isset($_POST['submit'])) {
    $nama = $_POST['anggota'];
    $role = $_POST['role'];
    $jam_kerja = $_POST['jam_kerja'];
    $harga_project = $_POST['harga_project'];

    echo "<h2>Data yang Dikirim:</h2>";
    echo "Nama Anggota: " . $nama . "<br>";
    echo "Posisi: " . $role . "<br>";
    echo "Jam Kerja: " . $jam_kerja . "<br>";
    echo "Jam Lembur: " . hitungJamLembur($jam_kerja) . "<br>";
    echo "<strong>Harga Project: " . number_format($harga_project, 0, ',', '.') . "</strong><br>";

    $upah_per_jam = $posisi[$role]['upah_per_jam'];
    $persen_lembur = $posisi[$role]['persen_lembur'];
    $persen_fee = $posisi[$role]['persen_fee'];
    $upah_jam_kerja = hitungUpahJamKerja($jam_kerja, $upah_per_jam);
    $upah_lembur = hitungUpahLembur($jam_kerja, $upah_per_jam, $persen_lembur);
    $upah_fee = hitungUpahFee($harga_project, $persen_fee);
    $total_upah = hitungTotalUpah($upah_jam_kerja, $upah_lembur, $upah_fee);

    echo "<h2>Perhitungan Upah:</h2>";
    echo "Upah dari Jam Kerja: Rp " . number_format($upah_jam_kerja, 0, ',', '.') . "<br>";
    echo "Upah dari Jam Lembur: Rp " . number_format($upah_lembur, 0, ',', '.') . "<br>";
    echo "Upah dari Fee Project: Rp " . number_format($upah_fee, 0, ',', '.') . "<br>";
    echo "<strong>Total Upah: Rp " . number_format($total_upah, 0, ',', '.') . "</strong>";
}
