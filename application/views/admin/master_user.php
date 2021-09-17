<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">','<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>') ?>
  <?= $this->session->flashdata('msg'); ?>

  <div class="row">
    <div class="col-lg-6">

     <?= form_open('Admin/UserController'); ?>

    <div class="form-group">
      <label for="username">NIK</label>
      <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" value="<?= set_value('nik') ?>" > 
    </div>

    <div class="form-group">
      <label for="password">Passsword</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
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

  </div>

  <div class="col-lg-6">
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama') ?>" placeholder="Masukkan Nama">
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
  </div>
      <?= form_close(); ?>
</div>

<!-- Page Heading -->
<h1 class="h3 mb-4 mt-5 text-gray-800">Data Petugas</h1>

<div class="table-responsive">
<table class="table" id="dataTable" style="font-size: 12px;">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Aksi</th>
      <th scope="col">NIK</th>
      <th scope="col">Nama</th>
      <th scope="col">Unit Kerja</th>
       <th scope="col">Level</th>
       <th scope="col">Foto</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; ?>
    <?php foreach ($user as $dp) : ?>
      <tr>
          <th scope="row"><?= $no++; ?></th>
          <td>
          <?php if ($dp->nik == $this->session->userdata('nik')) : ?>
            <small>Tidak ada aksi</small>
          <?php else : ?>
            <a href="<?= base_url('Admin/UserController/edit/'.$dp->iduser) ?>" class="btn btn-info btn-sm">Edit</a>
            <a href="<?= base_url('Admin/UserController/delete/'.$dp->iduser) ?>" class="btn btn-warning btn-sm">Hapus</a>
          <?php endif; ?>
          </td>
        <td><?= $dp->nik; ?></td>
        <td><?= $dp->nama; ?></td>
        <td><?= $dp->namasub.'-'.$dp->namaunit; ?></td>
        <td>
            <?php 
            if($dp->level == '1'){
                echo 'Admin';
            }
            else if($dp->level == '2'){
                echo 'Moderator';
            }
            else if($dp->level == '3'){
                echo 'Inspector';
            }
            ?>
        </td>
        <td>
             <img class="img-profile rounded-circle" style="width:40px" src="<?= base_url() ?>assets/profile/<?= $dp->foto; ?>"> 
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>

<!-- /.container-fluid -->
</div>