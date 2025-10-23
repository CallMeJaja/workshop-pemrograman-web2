<?php
$tahunAkademik = [
    "2020/2021",
    "2021/2022",
    "2022/2023",
    "2023/2024",
    "2024/2025",
    "2025/2026"
];

echo "<form action='#' method='POST'>";
echo "<select name='tahun_akademik'>";
echo "<option value='' disabled selected>-- Pilih Tahun Akademik --</option>";
foreach ($tahunAkademik as $tahun) {
    echo "<option value='$tahun'>$tahun</option>";
}
echo "</select>";
echo "<button type='submit' name='submit'>Submit</button>";
echo "</form>";

if (isset($_POST['submit'])) {
    $selectedYear = $_POST['tahun_akademik'];
    echo "Anda memilih tahun akademik $selectedYear";
}
