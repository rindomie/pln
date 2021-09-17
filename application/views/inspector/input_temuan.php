<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <a href="<?= base_url('Temuan/ProgresTemuan') ?>" class="btn btn-dark"><i class="fas fa-arrow-left"></i></a>
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">','<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>') ?>
  <?= $this->session->flashdata('msg'); ?>

  <div class="row">
    <div class="col-lg-6">

     <?= form_open('Inspector/TemuanController'); ?>

     <?php
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('subunit', 'user.unit = subunit.idsub','left');
		$this->db->join('unit', 'subunit.idunit = unit.idunit','left');
		$this->db->where('user.nik', $this->session->userdata('nik'));
		$user = $this->db->get()->row_array();
     ?>
     
    <div class="form-group">
      <label for="username">Inspector</label>
      <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" value="<?= $user['nik'].' - '.$user['nama']  ?>" readonly> 
    </div>

    <div class="form-group">
      <label for="nama">Unit Kerja</label>
      <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" value="<?= $user['namaunit'].'-'.$user['namasub'] ?>" readonly>
    </div>

    <div class="form-group">
      <label for="nama">Tgl temuan</label>
      <input type="date" class="form-control" id="tgl_temu" placeholder="Masukkan Nama" name="tgl_temu" value="">
    </div>

    <div class="form-group">
      <label for="nama">Kategori Temuan</label>
      <select name="kategori" id="kategori" class="form-control" >
          <option value="Unsafe Act">Unsafe Act</option>
          <option value="Unsafe Condition">Unsafe Condition</option>
          <option value="Nearmiss">Nearmiss</option>
          <option value="Accident">Accident</option>
      </select>
    </div>

    <div class="form-group">
      <label for="nama">Departemen</label>
      <select name="departemen" id="departemen" class="form-control" >
          <option value="Jaringan">Jaringan</option>
          <option value="Keamanan">Keamanan</option>
          <option value="Perawatan">Perawatan</option>
      </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
 <div class="col-lg-6">
    <div class="form-group">
      <label for="nama">Title Temuan</label>
      <input type="text" class="form-control" id="title" placeholder="Masukkan Title Temuan" name="title" value="">
    </div>

    <div class="form-group">
      <label for="nama">Lokasi Temuan</label>
      <textarea type="text" class="form-control" rows="2" id="lokasi" placeholder="Masukkan Lokasi Temuan" name="lokasi" value=""></textarea>
    </div>

    <div class="form-group">
      <label for="nama">Keterangan</label>
      <textarea class="form-control" rows="3.2" id="keterangan" placeholder="Masukkan Keterangan" name="keterangan" ></textarea>
    </div>

    <div class="form-group">
      <label for="nama">Foto Temuan</label>
      <input type="file" class="form-control" id="foto" placeholder="Masukkan Nama" name="foto">
    </div>

    <?= form_close(); ?>
  </div>
</div>

<!-- /.container-fluid -->
</div>