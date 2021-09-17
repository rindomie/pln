<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <a href="<?= base_url('Admin/UserController') ?>" class="btn btn-dark"><i class="fas fa-arrow-left"></i></a>
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">','<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>') ?>
  <?= $this->session->flashdata('msg'); ?>

  <div class="row">
    <div class="col-lg-6">

     <?= form_open('Admin/UserController/edit_unit/'.$user['iduser']); ?>
     
    <div class="form-group">
      <label for="username">Nama Unit</label>
      <input type="text" class="form-control" id="namaunit" name="namaunit" placeholder="Masukkan Nama Unit Kerja" value="<?= set_value('namaunit') ?>" > 
    </div>

    <div class="form-group">
      <label for="password">Alamat</label>
      <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" value="<?= set_value('alamat') ?>"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <?= form_close(); ?>
  </div>
</div>

<!-- /.container-fluid -->
</div>