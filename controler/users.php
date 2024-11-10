<?php
require_once('function.php');
include_once('templates/header.php');
?>
<?php
if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
  echo "<script>alert('Anda tidak memiliki akses!')</script>";
  echo "<script>window.location.href='index.php'</script>";
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Data User</h1>

  <?php

  if (isset($_POST['simpan'])) {
    if (tambah_user($_POST) > 0) {
  ?>
      <div class="alert alert-success" role="alert">
        Data berhasil disimpan!
      </div>
    <?php
    } else {
    ?>
      <div class="alert alert-danger">
        Data gagal disimpan!
      </div>
    <?php
    }
  } else if (isset($_POST['ganti_password'])) {
    if (ganti_password($_POST) > 0) {
    ?>
      <div class="alert alert-success" role="alert">
        Password Berhasil Diubah!
      </div>
    <?php
    } else {
    ?>
      <div class="alert alert-danger" role="alert">
        password gagal Diubah!
      </div>
  <?php
    }
  }
  ?>




  <!-- DataTales tambah -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <button type="button" class="btn btn-primary btn-icon-split"
        data-toggle="modal" data-target="#tambahModal">
        <span class="icon text-while-50">
          <i class="fas fa-plus"></i>z
        </span>
        <span class="text">Data user</span>
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>User Role</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $users = query("SELECT * FROM `users`");
            foreach ($users as $user) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['user_role'] ?></td>
                <td><button type="button" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#gantiPassword" data-id="<?= $user['id_users'] ?>">
                    <span class="text">Ganti Password</span>
                  </button>
                  <a class="btn btn-success" href="edit-users.php?id=<?= $user['id_users'] ?>">Ubah</a>
                  <a onclick="confirm('Apakah anda yakin ingin menghapus data user?')" class="btn btn-danger" href="hapus-users.php?id=<?= $user['id_users'] ?>">Hapus</a><br>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php
  $query = mysqli_query($koneksi, "SELECT max(id_users) as kodeTerbesar FROM `users`");
  //   var_dump($query);
  $data = mysqli_fetch_array($query);
  $kodeuser = $data["kodeTerbesar"];

  $urutan = (int) substr($kodeuser, 3, 2);

  $urutan++;

  $huruf = "usr";
  $kodeuser = $huruf . sprintf("%02s", $urutan);

  ?>

  <!-- modal ganti password -->
  <!-- Modal Ganti Password -->
  <div class="modal fade" id="gantiPassword" tabindex="-1" aria-labelledby="gantiPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="gantiPasswordLabel">Ganti Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="">
            <input type="hidden" name="id_user" id="id_user">
            <div class="form-group row">
              <label for="password" class="col-sm-4 col-form-label">Password Baru</label>
              <div class="col-sm-7">
                <input type="password" class="form-control" id="password" name="password">
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" name="ganti_password" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>






  <!-- Modal -->
  <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah data user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="">
            <input type="hidden" name="id_user" id="id_user" value="<?= $kodeuser ?>">
            <div class="form-group row">
              <label for="username" class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="username" name="username">
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password">
              </div>
            </div>
            <div class="form-group row">
              <label for="user_role" class="col-sm-3 col-form-label">User Role</label>
              <div class="col-sm-8">
                <select class="form-control" name="user_role" id="user_role">
                  <option value="admin">Administrator</option>
                  <option value="operator">Operator</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
              <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php
  include_once('templates/footer.php')
  ?>