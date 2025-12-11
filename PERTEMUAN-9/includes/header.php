<?php
// Get current page for active nav highlighting
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Sistem Informasi Akademik Kampus' ?></title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: none;
        }

        .table th {
            background-color: #0d6efd;
            color: white;
        }

        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }

        .menu-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .footer {
            background-color: #212529;
            color: #adb5bd;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <i class="bi bi-mortarboard-fill me-2"></i>SIAKAD Kampus
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'index.php' ? 'active' : '' ?>" href="../index.php">
                            <i class="bi bi-house-door me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array($currentPage, ['view_dosen.php', 'view_mk.php', 'view_mahasiswa.php', 'view_nilai.php']) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-database me-1"></i>Data Master
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item <?= $currentPage === 'view_dosen.php' ? 'active' : '' ?>" href="../views/view_dosen.php">
                                    <i class="bi bi-person-badge me-2"></i>Data Dosen
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= $currentPage === 'view_mk.php' ? 'active' : '' ?>" href="../views/view_mk.php">
                                    <i class="bi bi-book me-2"></i>Data Mata Kuliah
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= $currentPage === 'view_mahasiswa.php' ? 'active' : '' ?>" href="../views/view_mahasiswa.php">
                                    <i class="bi bi-people me-2"></i>Data Mahasiswa
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item <?= $currentPage === 'view_nilai.php' ? 'active' : '' ?>" href="../views/view_nilai.php">
                                    <i class="bi bi-card-checklist me-2"></i>Data Nilai
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>