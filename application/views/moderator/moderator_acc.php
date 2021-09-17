<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">','<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>') ?>
  <?= $this->session->flashdata('msg'); ?>

<!-- Page Heading -->
<div class="table-responsive">
<table class="table" style="font-size: 12px;" id="dataTable">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Aksi</th>
      <th scope="col">NIK</th>
      <th scope="col">Nama</th>
      <th scope="col">Unit Kerja</th>
       <th scope="col">Judul Temuan</th>
       <th scope="col">Keterangan</th>
       <th scope="col">Bukti Foto</th>
       <th scope="col">Status Temuan</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $unit = $this->session->userdata('unit');
    //   var_dump($unit);
    //   die;
      $query = "SELECT *, u.`iduser`,  u.`nik` nikpenemu, u.`nama` penemu, m.`iduser`, m.`nik` nikmoderator,m.`nama` moderator, t.`foto` bukti FROM temuan t 
            LEFT JOIN USER u ON t.`idpenemu` = u.`iduser` 
            LEFT JOIN USER m ON t.`idmoderator` = m.`iduser`
            LEFT JOIN subunit s ON u.unit = s.idsub 
            LEFT JOIN unit un ON s.idunit = un.idunit WHERE u.`unit` = $unit AND t.ststemuan = 'disetujui'

--             SELECT *, u.`iduser`, u.`nama` penemu, m.`iduser`, m.`nama` moderator FROM temuan t 
-- LEFT JOIN USER u ON t.`idpenemu` = u.`iduser` 
-- LEFT JOIN USER m ON t.`idmoderator` = m.`iduser`
-- LEFT JOIN subunit s ON u.unit = s.idsub 
-- LEFT JOIN unit un ON s.idunit = un.idunit 
-- WHERE u.`unit` = $unit
";
      $cek = $this->db->query($query)->result();
      
      ?>
    <?php $no = 1; ?>
    <?php foreach ($cek as $dp) : ?>
      <tr>
          <th scope="row"><?= $no++; ?></th>
          <td>
            <a href="" data-toggle="modal" data-target="#detail<?= $dp->idtemuan ?>" class="btn btn-primary btn-sm btn-block mb-2">Detail</a>
            <div class="modal fade" id="detail<?= $dp->idtemuan ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addNewDonaturLabel">Detail Temuan <?= $dp->idtemuan;?> </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- <form action="<?= base_url('karyawan/updatekaryawan') ?>" method="post"> -->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Detail Temuan</h6>
                                        <div class="form-group">
                                            <label>No. Temuan</label>
                                            <input type="text" class="form-control" id="id" name="id" value="<?= $dp->idtemuan; ?>" placeholder="Nama" required="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Tgl Temuan</label>
                                            <input type="text" class="form-control" id="tgl" name="tgl" value="<?= $dp->tgltemuan; ?>" placeholder="Nama" required="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Temuan</label>
                                            <input type="text" class="form-control" id="title" name="title" value="<?= $dp->title; ?>" placeholder="Nama" required="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea type="text" rows="3" class="form-control" id="ket" name="ket" value="" placeholder="Nama" required="" readonly><?= $dp->keterangan; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipe Temuan</label>
                                            <input type="text" class="form-control" id="tipe" name="tipe" value="<?= $dp->tipetemuan; ?>" placeholder="Nama" required="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Inspector</label>
                                            <input type="text" class="form-control" id="inspector" name="inspector" value="<?= $dp->nikpenemu.'-'.$dp->penemu; ?>" placeholder="Nama" required="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Unit Kerja</label>
                                            <input type="text" class="form-control" id="unit" name="unit" value="<?= $dp->namaunit.'-'.$dp->namasub; ?>" placeholder="Nama" required="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi Temuan</label>
                                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $dp->lokasi; ?>" placeholder="Nama" required="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Temuan</label>
                                            <input type="text" class="form-control" id="ststemuan" name="ststemuan" value="<?= $dp->ststemuan; ?>" placeholder="Nama" required="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if($dp->ststemuan != 'ditolak'){  ?>
                                        <h6>Tanggapan</h6>
                                        <div class="form-group">
                                            <label>Moderator</label>
                                            <input type="text" class="form-control" id="inspector" name="inspector" value="<?= $dp->nikmoderator.'-'.$dp->moderator; ?>" placeholder="Nama" required="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggapan</label>
                                            <textarea type="text" rows="3" class="form-control" id="tanggapn" name="tanggapan" value="" placeholder="" required="" readonly><?= $dp->tanggapan; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Department</label>
                                            <input type="text" class="form-control" id="dept" name="dept" value="<?= $dp->pjdept; ?>" placeholder="" required="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Deadline</label>
                                            <input type="text" class="form-control" id="deadline" name="deadline" value="<?= $dp->deadline; ?>" placeholder="" required="" readonly>
                                        </div>
                                        <?php } else if($dp->ststemuan == 'ditolak') {?>
                                            <h6>Tanggapan</h6>
                                        <div class="form-group">
                                            <label>Moderator</label>
                                            <input type="text" class="form-control" id="inspector" name="inspector" value="<?= $dp->nikmoderator.'-'.$dp->moderator; ?>" placeholder="Nama" required="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Alasan Ditolak</label>
                                            <textarea type="text" rows="3" style="height: 120px" class="form-control" id="tanggapn" name="tanggapan" value="" placeholder="Nama" required="" readonly><?= $dp->tanggapan; ?></textarea>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
          
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <!-- <button type="submit" class="btn btn-primary">Update</button> -->
                            </div>

                        <!-- </form> -->
                    </div>
                </div>
            </div>
            <a href="" data-toggle="modal" data-target="#done<?= $dp->idtemuan ?>" class="btn btn-success btn-sm btn-block mb-2">Selesai</a>
            <div class="modal fade" id="done<?= $dp->idtemuan ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addNewDonaturLabel">Done Temuan <?= $dp->idtemuan;?> </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= form_open_multipart('Moderator/ModeratorController/done/'.$dp->idtemuan); ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>Konfirmasi Selesai Temuan</h6>
                                        <div class="form-group">
                                            <p style="font-size: 14px;">Apakah anda ingin mengubah status temuan menjadi selesai?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Konfirmasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          <!-- <?= $dp->status;?> -->
          </td>
        <td><?= $dp->nikpenemu; ?></td>
        <td><?= $dp->penemu; ?></td>
        <td><?= $dp->namasub.'-'.$dp->namaunit; ?></td>
        <td>
            <?=$dp->title;?>
        </td>
        <td>
            <?=$dp->keterangan;?>
        </td>
        <td>
             <img class="img-profile" style="width: 100px" src="<?= base_url() ?>assets/uploads/laporan/<?= $dp->bukti; ?>"> 
        </td>
        <td>
            <?php if($dp->ststemuan == 'diproses') { ?>
                <span class="badge badge-primary" style="height: 25px; width:80px; font-size:14px;"><b><?=$dp->ststemuan;?></b></span>
            <?php } else if($dp->ststemuan == 'disetujui') { ?>
                <span class="badge badge-success badge-block badge-md" style="height: 25px; width:80px; font-size:14px;"><b><?=$dp->ststemuan;?></b></span>
            <?php } else if($dp->ststemuan == 'ditolak') { ?>
                <span class="badge badge-danger badge-block badge-md" style="height: 25px; width:80px; font-size:14px;"><b><?=$dp->ststemuan;?></b></span>
            <?php } ?>
            
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>



<!-- /.container-fluid -->
</div>