z<?php
require_once('function.php');
include_once('templates/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Data user</h1>


    <?php
    //Jika ada Tombol simpan
    if (isset($_POST['simpan'])) {
        // var_dump($_POST);
        if (ubah_user($_POST) > 0) {
    ?>
            <div class="alert alert-success" role="alert">
                Data Berhasil Diubah!
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Data Gagal Diubah!
            </div>
    <?php
        }
    }
    ?>

    <?php
    if (isset($_GET['id'])) {
        $id_user = $_GET['id'];
        // ambil data user yang sesuai dengan id user
        $data = query("SELECT * FROM `users` WHERE id_users = '$id_user'")[0];
    }
    ?>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6>Data user</h6>
        </div>
            <div class="card-body">
                <form method="post" action="">
                    <input type="hidden" name="id_user" id="id_user" value="<?= $id_user ?>">
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username" name="username" value="<?= $data['username']?>">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="user_role" class="col-sm-3 col-form-label">User Role</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="user_role" id="user_role">
                                <option value="admin" <?= $data['user_role'] == 'admin' ? 'selected' : ''; ?>>Administrator</option>
                                <option value="operator" <?= $data['user_role'] == 'operator' ? 'selected' : ''; ?>>Operator</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label"></label>
                        <div>
                            <a type="button" class="btn btn-danger btn-icon-split" href="users.php">
                                <span class="icon text-white-50">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                                <span class="text">Kembali</span>
                            </a>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>

<!-- jika ada id_user di URL -->



<!-- /.container-fluid -->


<?php
include_once('templates/footer.php')
?>