<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pencarian dan Pengurutan Angka</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h3 class="mb-0 text-center">Pencarian dan Pengurutan Angka</h3>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="row">
                <div class="col-md-4 mb-3">
                  <label for="angka1" class="form-label">Angka 1 <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="angka1" name="angka1"
                    placeholder="Masukkan angka 1" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="angka2" class="form-label">Angka 2 <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="angka2" name="angka2"
                    placeholder="Masukkan angka 2" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="angka3" class="form-label">Angka 3 <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="angka3" name="angka3"
                    placeholder="Masukkan angka 3" required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="angka4" class="form-label">Angka 4 <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="angka4" name="angka4"
                    placeholder="Masukkan angka 4" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="angka5" class="form-label">Angka 5 <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="angka5" name="angka5"
                    placeholder="Masukkan angka 5" required>
                </div>
              </div>

              <div class="d-grid gap-2">
                <button type="submit" name="hitung" class="btn btn-primary">
                  Proses Data
                </button>
              </div>
            </form>

            <?php
            if (isset($_POST['hitung'])) {
              $angka1 = (int)$_POST['angka1'];
              $angka2 = (int)$_POST['angka2'];
              $angka3 = (int)$_POST['angka3'];
              $angka4 = (int)$_POST['angka4'];
              $angka5 = (int)$_POST['angka5'];

              /*
                            * Menggunakan Algoritma Bubble Sort (Terbesar ke Terkecil) secara manual
                            */

              if ($angka1 < $angka2) {
                $t = $angka1;
                $angka1 = $angka2;
                $angka2 = $t;
              }
              if ($angka2 < $angka3) {
                $t = $angka2;
                $angka2 = $angka3;
                $angka3 = $t;
              }
              if ($angka3 < $angka4) {
                $t = $angka3;
                $angka3 = $angka4;
                $angka4 = $t;
              }
              if ($angka4 < $angka5) {
                $t = $angka4;
                $angka4 = $angka5;
                $angka5 = $t;
              }

              if ($angka1 < $angka2) {
                $t = $angka1;
                $angka1 = $angka2;
                $angka2 = $t;
              }
              if ($angka2 < $angka3) {
                $t = $angka2;
                $angka2 = $angka3;
                $angka3 = $t;
              }
              if ($angka3 < $angka4) {
                $t = $angka3;
                $angka3 = $angka4;
                $angka4 = $t;
              }
              if ($angka4 < $angka5) {
                $t = $angka4;
                $angka4 = $angka5;
                $angka5 = $t;
              }

              if ($angka1 < $angka2) {
                $t = $angka1;
                $angka1 = $angka2;
                $angka2 = $t;
              }
              if ($angka2 < $angka3) {
                $t = $angka2;
                $angka2 = $angka3;
                $angka3 = $t;
              }
              if ($angka3 < $angka4) {
                $t = $angka3;
                $angka3 = $angka4;
                $angka4 = $t;
              }
              if ($angka4 < $angka5) {
                $t = $angka4;
                $angka4 = $angka5;
                $angka5 = $t;
              }

              if ($angka1 < $angka2) {
                $t = $angka1;
                $angka1 = $angka2;
                $angka2 = $t;
              }
              if ($angka2 < $angka3) {
                $t = $angka2;
                $angka2 = $angka3;
                $angka3 = $t;
              }
              if ($angka3 < $angka4) {
                $t = $angka3;
                $angka3 = $angka4;
                $angka4 = $t;
              }
              if ($angka4 < $angka5) {
                $t = $angka4;
                $angka4 = $angka5;
                $angka5 = $t;
              }
            ?>
              <div class="mt-4">
                <div class="accordion" id="accordionResults">
                  <!-- Section 1 (Pencarian Angka Terbesar/Terkecil) -->
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <strong>Pencarian Angka Terbesar dan Terkecil</strong>
                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionResults">
                      <div class="accordion-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="card bg-success text-white">
                              <div class="card-body text-center">
                                <h5 class="card-title">Angka Terbesar</h5>
                                <h2 class="display-4"><?php echo $angka1; ?></h2>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="card bg-info text-white">
                              <div class="card-body text-center">
                                <h5 class="card-title">Angka Terkecil</h5>
                                <h2 class="display-4"><?php echo $angka5; ?></h2>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Section 2 (Urutan Angka) -->
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <strong>Urutan Angka (Terbesar ke Terkecil & Terkecil ke Terbesar)</strong>
                      </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionResults">
                      <div class="accordion-body">
                        <!-- Urutan dari Terbesar ke Terkecil -->
                        <div class="card mb-3">
                          <div class="card-header bg-warning">
                            <strong>Urutan dari Terbesar ke Terkecil</strong>
                          </div>
                          <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                              <span class="badge bg-primary fs-4 px-3 py-2"><?php echo $angka1; ?></span>
                              <span class="badge bg-primary fs-4 px-3 py-2"><?php echo $angka2; ?></span>
                              <span class="badge bg-primary fs-4 px-3 py-2"><?php echo $angka3; ?></span>
                              <span class="badge bg-primary fs-4 px-3 py-2"><?php echo $angka4; ?></span>
                              <span class="badge bg-primary fs-4 px-3 py-2"><?php echo $angka5; ?></span>
                            </div>
                          </div>
                        </div>

                        <!-- Urutan dari Terkecil ke Terbesar -->
                        <div class="card">
                          <div class="card-header bg-info text-white">
                            <strong>Urutan dari Terkecil ke Terbesar</strong>
                          </div>
                          <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                              <span class="badge bg-secondary fs-4 px-3 py-2"><?php echo $angka5; ?></span>
                              <span class="badge bg-secondary fs-4 px-3 py-2"><?php echo $angka4; ?></span>
                              <span class="badge bg-secondary fs-4 px-3 py-2"><?php echo $angka3; ?></span>
                              <span class="badge bg-secondary fs-4 px-3 py-2"><?php echo $angka2; ?></span>
                              <span class="badge bg-secondary fs-4 px-3 py-2"><?php echo $angka1; ?></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
