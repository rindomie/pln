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

     <?= form_open('Admin/UserController/edit/'.$user['iduser']); ?>
     
         <div class="form-group">
      <label for="username">NIK</label>
      <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" value="<?= $user['nik'] ?>" > 
    </div>

     <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" value="<?= $user['nama'] ?>">
    </div>

    <div class="form-group">
      <label for="lokasi">Unit Kerja</label>
      <!-- <input type="text" class="form-control" id="telp" placeholder="" name="telp" value="<?= set_value('telp') ?>"> -->
      <select name="unit" id="unit" class="form-control" >
          <option value="" disable hidden>Pilih Lokasi Kerja</option>
            <?php foreach($lokasi as $l) { ?>
                <option value="<?=$l->idsub?>"><?= $l->namasub.'-'.$l->namaunit;?></option>
            <?php } ?>
      </select>
    </div>

    <label for="">Level</label>
    <div class="form-group">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="level" id="admin" value="1">
        <label class="form-check-label" for="admin">Admin</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="level" id="moderator" value="2">
        <label class="form-check-label" for="moderator">Moderator</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="level" id="inspector" value="3">
        <label class="form-check-label" for="inspector">Inspector</label>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <?= form_close(); ?>
  </div>
</div>

<!-- /.container-fluid -->
</div>