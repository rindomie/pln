<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
		<div class="col-lg-8">
			<?= $this->session->flashdata('pesan'); ?>
		</div>
	</div>

	<div class="card mb-3 col-lg-8">
		<div class="row no-gutters">
			<div class="col-md-3">
				<img src="<?= base_url('assets/profile/'.$user['foto']) ?>" class="card-img mt-4 mb-2 img-circle w-100 img-thumbnail" alt="img user">
				<p><button class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#foto<?= $user['iduser'] ?>">Ganti Foto</button></p>
				<div class="modal fade" id="foto<?= $user['iduser'] ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="addNewDonaturLabel">Update Foto</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?= form_open_multipart('User/ProfileController/UpdateFoto/'.$user['iduser']); ?>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Pilih Foto</label>
												<input type="file" class="form-control" id="foto" name="foto" required>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card-body">
					<h5 class="card-title">NIK : <?= $user['nik']; ?></h5>
					<p class="card-text">Nama : <?= $user['nama'] ?> </p>
					<p class="card-text">Unit Kerja : <?= $user['namasub'].'-'.$user['namaunit'] ?></p>
					<p class="card-text">Level : 
						<?php if($user['level'] == '1') {
							echo 'Admin';
						} else  if($user['level'] == '2') {
							echo 'Moderator';
						} else  if($user['level'] == '3') {
							echo 'Inspector'; }?>
					</p>
					<!-- <p class="card-text"><small class="text-muted">Member since </small></p> -->
					
				</div>
			</div>
		</div>
	</div>

</div>
        <!-- /.container-fluid