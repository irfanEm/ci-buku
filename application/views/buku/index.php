<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f9fafb;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .btn {
      border-radius: 8px;
      font-weight: 500;
    }
    .table thead {
      border-bottom: 2px solid #e9ecef;
    }
    .table td, .table th {
      vertical-align: middle;
      border: none;
    }
    .search-bar input {
      height: 45px;
      border-radius: 8px;
    }
    .pagination .page-link {
      border-radius: 6px;
      color: #333;
    }
    .pagination .active .page-link {
      background-color: #0d6efd;
      border-color: #0d6efd;
      color: #fff;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="mb-0 fw-semibold">📘 Daftar Buku</h4>
      <a href="<?= site_url('buku/tambah') ?>" class="btn btn-success">+ Tambah</a>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <form method="get" action="<?= site_url('buku') ?>" class="row g-2 align-items-center mb-4">
      <div class="col-md-10 search-bar">
        <input type="text" name="q" class="form-control" placeholder="🔍 Cari berdasarkan judul..." value="<?= $this->input->get('q') ?>">
      </div>
      <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-primary w-100">Cari</button>
        <a href="<?= site_url('buku') ?>" class="btn btn-outline-secondary w-100">Reset</a>
      </div>
    </form>

    <?php if (empty($buku)): ?>
      <div class="alert alert-info text-center">Belum ada data buku.</div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-hover table-borderless align-middle">
          <thead class="table-light text-center">
            <tr>
              <th style="width: 50px;">#</th>
              <th class="text-start">Judul</th>
              <th class="text-start">Penulis</th>
              <th style="width: 130px;">Tahun</th>
              <th style="width: 150px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($buku as $index => $b): ?>
              <tr>
                <td class="text-center"><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($b->judul) ?></td>
                <td><?= htmlspecialchars($b->penulis) ?></td>
                <td class="text-center"><?= $b->tahun_terbit ?></td>
                <td class="text-center">
                  <a href="<?= site_url('buku/edit/' . $b->id) ?>" class="btn btn-sm btn-outline-warning me-1">Edit</a>
                  <a href="<?= site_url('buku/hapus/' . $b->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>

    <?php if (!empty($pagination)): ?>
      <div class="mt-4 d-flex justify-content-center">
        <?= $pagination ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
