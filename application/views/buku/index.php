<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container mt-5">
  <h2 class="mb-4">Daftar Buku</h2>

  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $this->session->flashdata('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

	<form class="row mb-3" method="get" action="<?= site_url('buku') ?>">
		<div class="col-md-10">
			<input type="text" name="q" class="form-control" placeholder="Cari berdasarkan judul..." value="<?= $this->input->get('q') ?>">
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-primary">Cari</button>
			<a href="<?= site_url('buku') ?>" class="btn btn-secondary">Reset</a>
		</div>
	</form>

  <a href="<?= site_url('buku/tambah') ?>" class="btn btn-success mb-3">+ Tambah Buku</a>

  <?php if (empty($buku)): ?>
    <div class="alert alert-info">Belum ada data buku.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-light">
          <tr>
            <th scope="col" style="width: 50px;">#</th>
            <th scope="col" class="text-start">Judul</th>
            <th scope="col" class="text-start">Penulis</th>
            <th scope="col" style="width: 130px;">Tahun Terbit</th>
            <th scope="col" style="width: 150px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($buku as $index => $b): ?>
            <tr>
              <th scope="row"><?= $index + 1 ?></th>
              <td class="text-start"><?= htmlspecialchars($b->judul) ?></td>
              <td class="text-start"><?= htmlspecialchars($b->penulis) ?></td>
              <td><?= $b->tahun_terbit ?></td>
              <td>
                <a href="<?= site_url('buku/edit/' . $b->id) ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                <a href="<?= site_url('buku/hapus/' . $b->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

	  
    </div>
	<?php endif; ?>
	<div class="mt-3">
	  <?= $pagination ?>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
