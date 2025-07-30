<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card shadow-sm rounded">
        <div class="card-body">
          <h4 class="mb-4">Tambah Buku Baru</h4>

          <?php if (validation_errors()): ?>
            <div class="alert alert-danger">
              <?= validation_errors() ?>
            </div>
          <?php endif; ?>

          <form action="<?= site_url('buku/simpan') ?>" method="post">
            <div class="mb-3">
              <label for="judul" class="form-label">Judul</label>
              <input type="text" class="form-control" id="judul" name="judul" value="<?= set_value('judul') ?>" required>
            </div>

            <div class="mb-3">
              <label for="penulis" class="form-label">Penulis</label>
              <input type="text" class="form-control" id="penulis" name="penulis" value="<?= set_value('penulis') ?>" required>
            </div>

            <div class="mb-3">
              <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
              <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?= set_value('tahun_terbit') ?>" required>
            </div>

            <div class="d-flex justify-content-between">
              <a href="<?= site_url('buku') ?>" class="btn btn-secondary">Kembali</a>
              <button type="submit" class="btn btn-primary">Simpan Buku</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
