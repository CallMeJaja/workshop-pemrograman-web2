    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - SIAKAD Kampus</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    </head>

    <body class="bg-light">

        <div class="container py-5">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <i class="bi bi-mortarboard-fill display-4 d-block mb-2"></i>
                            <h3 class="mb-1 fw-bold">SIAKAD Kampus</h3>
                            <p class="mb-0 opacity-75">Sistem Informasi Akademik</p>
                        </div>
                        <div class="card-body p-4">
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <?= htmlspecialchars($error) ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($_GET['logout'])): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    Anda berhasil logout.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($_GET['error']) && $_GET['error'] === 'unauthorized'): ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="bi bi-shield-exclamation me-2"></i>
                                    Anda tidak memiliki akses ke halaman tersebut.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <form action="/index.php?modul=auth&fitur=login" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label fw-semibold">
                                        <i class="bi bi-person me-1"></i>Username
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-person-fill text-secondary"></i>
                                        </span>
                                        <input type="text" class="form-control form-control-lg" id="username" name="username"
                                            placeholder="Masukkan username" required autofocus>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="bi bi-lock me-1"></i>Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-lock-fill text-secondary"></i>
                                        </span>
                                        <input type="password" class="form-control form-control-lg" id="password" name="password"
                                            placeholder="Masukkan password" required>
                                    </div>
                                </div>

                                <div class="mb-4 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label text-muted" for="remember">Ingat saya</label>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                                    </button>
                                </div>
                            </form>

                            <hr class="my-4">

                            <p class="text-center text-muted mb-0">
                                <small>
                                    <i class="bi bi-shield-lock me-1"></i>
                                    &copy; <?= date('Y') ?> SIAKAD Kampus
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>