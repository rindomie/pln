<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">','<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>') ?>
  <?= $this->session->flashdata('msg'); ?>

  <div class="row">
    <div class="col-lg-6">
        <h4>Tambah Unit Kerja</h4>

     <?= form_open('Admin/UnitController'); ?>

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
  <div class="col-lg-6">
        <h4>Tambah Sub Unit Kerja</h4>

     <?= form_open('Admin/UnitController/addsub'); ?>

    <div class="form-group">
      <label for="username">Nama Sub Unit</label>
      <input type="text" class="form-control" id="namasub" name="namasub" placeholder="Masukkan Nama SUb Unit Kerja" value=""> 
    </div>

    <div class="form-group">
      <label for="lokasi">Unit Kerja</label>
      <!-- <input type="text" class="form-control" id="telp" placeholder="" name="telp" value="<?= set_value('telp') ?>"> -->
      <select name="idunit" id="idunit" class="form-control" >
          <option value="" disable hidden>Pilih Unit Kerja</option>
            <?php foreach($unit as $l) { ?>
                <option value="<?=$l->idunit?>"><?= $l->namaunit;?></option>
            <?php } ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>

    <?= form_close(); ?>
  </div>

</div>

<!-- Page Heading -->
<h1 class="h3 mb-4 mt-5 text-gray-800">Data Unit Kerja</h1>

<div class="table-responsive">
<table class="table" id="dataTable" style="font-size: 12px;">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <!-- <th scope="col">Aksi</th> -->
      <th scope="col">Nama Unit</th>
      <th scope="col">Alamat</th>
      <th scope="col">Sub Unit</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; ?>
    <?php foreach ($unit as $dp) : ?>
      <tr>
          <th scope="row"><?= $no++; ?></th>
          <!-- <td>
            <a href="<?= base_url('Admin/UnitController/addsub/'.$dp->idunit) ?>" class="btn btn-primary btn-sm">Tambah</a>
            <a href="<?= base_url('Admin/UnitController/edit/'.$dp->idunit) ?>" class="btn btn-info btn-sm">Edit</a>
            <a href="<?= base_url('Admin/UnitController/delete/'.$dp->idunit) ?>" class="btn btn-warning btn-sm">Hapus</a>
          </td> -->
        <td><?= $dp->namaunit; ?></td>
        <td><?= $dp->alamat; ?></td>
        <td>
            <?php 

                $query = "SELECT * FROM subunit JOIN unit ON subunit.idunit = unit.idunit WHERE subunit.`idunit` = '$dp->idunit'";
                $cek = $this->db->query($query);
                echo "<ul>";
                foreach($cek->result() as $sub){
                    echo '<li>'.$sub->namasub.'</li>';
                }
                echo "</ul>";
            ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>


<!-- Modal -->
<!-- 
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#subModal">
                Tambah Sub Unit
                </button>    
<div class="modal fade" id="subModal" tabindex="-1" role="dialog" aria-labelledby="subModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="row">
    <div class="col-lg-12">

            <?= form_open('Admin/UnitController'); ?>

            <div class="form-group">
            <label for="username">Nama Unit</label>
            <input type="text" class="form-control" id="namaunit" name="namaunit" placeholder="Masukkan Nama Unit Kerja" value="<?= set_value('namaunit') ?>" > 
            </div>

            <div class="form-group">
            <label for="password">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" value="<?= set_value('alamat') ?>"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </div>
            <?= form_close(); ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div> -->

<!-- /.container-fluid -->
</div>

