<?php
$matriks = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

echo $matriks[0][0] . "<br>";
echo $matriks[1][1] . "<br>";

$artikel = [
    [
        "judul" => "Belajar PHP Dasar",
        "penulis" => "Eza Pratama",
        "bahasa" => [
            "PHP",
            "HTML",
            "CSS"
        ]

    ],
    [
        "judul" => "Mengenal JavaScript",
        "penulis" => "Siti Aminah",
        "bahasa" => [
            "JavaScript",
            "HTML",
            "CSS"
        ]
    ]
];

echo "<h3>" . $artikel[0]["judul"] . "</h3>";
echo "<p>Penulis: " . $artikel[0]['penulis'] . "</p>";
echo "<hr>";

foreach ($artikel as $post) {
    echo "<h3>" . $post["judul"] . "</h3>";
    echo "<p>Penulis: " . $post["penulis"] . "</p>";
    echo "<p>Bahasa Pemrograman: </p>";
    echo "<ul>";
    foreach ($post["bahasa"] as $lang) {
        echo "<li>" . $lang . "</li>";
    }
    echo "</ul>";
    echo "<hr>";
}
