<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Simple active state detection based on URI
$uri = $_SERVER['REQUEST_URI'];
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

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/index.php">
                <i class="bi bi-mortarboard-fill me-2"></i>SIAKAD Kampus
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= strpos($uri, '/index.php') !== false || $uri == '/' ? 'active' : '' ?>" href="/index.php">
                            <i class="bi bi-house-door me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= strpos($uri, '/views/') !== false ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-database me-1"></i>Data Master
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item <?= strpos($uri, '/dosen/') !== false ? 'active' : '' ?>" href="/views/dosen/index.php">
                                    <i class="bi bi-person-badge me-2"></i>Data Dosen
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= strpos($uri, '/mahasiswa/') !== false ? 'active' : '' ?>" href="/views/mahasiswa/index.php">
                                    <i class="bi bi-people me-2"></i>Data Mahasiswa
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= strpos($uri, '/matkul/') !== false ? 'active' : '' ?>" href="/views/matkul/index.php">
                                    <i class="bi bi-book me-2"></i>Data Mata Kuliah
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item <?= strpos($uri, '/nilai/') !== false ? 'active' : '' ?>" href="/views/nilai/index.php">
                                    <i class="bi bi-card-checklist me-2"></i>Data Nilai
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header text-white" id="toastHeader">
                <i class="bi me-2" id="toastIcon"></i>
                <strong class="me-auto" id="toastTitle">Notifikasi</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastMessage">
                <!-- Message will be injected here -->
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toastEl = document.getElementById('liveToast');
                const toastHeader = document.getElementById('toastHeader');
                const toastIcon = document.getElementById('toastIcon');
                const toastTitle = document.getElementById('toastTitle');
                const toastMessage = document.getElementById('toastMessage');

                // Data from PHP Session
                const type = '<?= $_SESSION['flash_message']['type'] ?>';
                const message = '<?= addslashes($_SESSION['flash_message']['message']) ?>';

                // Configure Toast Appearance
                if (type === 'success') {
                    toastHeader.classList.add('bg-success');
                    toastIcon.classList.add('bi-check-circle-fill');
                    toastTitle.innerText = 'Berhasil';
                } else if (type === 'error') {
                    toastHeader.classList.add('bg-danger');
                    toastIcon.classList.add('bi-exclamation-triangle-fill');
                    toastTitle.innerText = 'Gagal';
                } else if (type === 'warning') {
                    toastHeader.classList.add('bg-warning');
                    toastHeader.classList.remove('text-white'); // Warning usually black text
                    toastEl.querySelector('.btn-close').classList.remove('btn-close-white');
                    toastIcon.classList.add('bi-exclamation-circle-fill');
                    toastTitle.innerText = 'Peringatan';
                } else {
                    toastHeader.classList.add('bg-primary');
                    toastIcon.classList.add('bi-info-circle-fill');
                    toastTitle.innerText = 'Informasi';
                }

                toastMessage.innerText = message;

                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            });
        </script>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>