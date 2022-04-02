<!DOCTYPE html>
<html lang="en">
<div class="container mt-5" style="margin-top:150px!important">
<body id="page-top">
	<div id="wrapper">

		<div id="content-wrapper">

			<div class="container-fluid">


				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<!-- Card  -->
				<div class="card mb-3">
					<div class="card-header">

						<a href="<?php echo site_url('Penyakit') ?>"><i class="fas fa-arrow-left"></i>
							Kembali</a>
					</div>
					<div class="card-body">

						<form action="" method="post" enctype="multipart/form-data">
						<!-- Note: atribut action dikosongkan, artinya action-nya akan diproses 
							oleh controller tempat vuew ini digunakan. Yakni index.php/admin/products/edit/ID --->

							<input type="hidden" name="id" value="<?php echo $penyakit->kode?>" />
							<div class="form-group">
								<label  style="color:black;" for="kode">Kode</label>
								<p style="color:black;" class=" <?php echo form_error('kode') ? 'is-invalid':'' ?>"
								 type="text" name="kode" placeholder="kode" value="" > <?php echo $penyakit->kode ?> </p>
								 <?= form_error('kode' , "<small class='text-danger pl-3'>",'</small>'); ?> 
							</div>
							<div class="form-group">
								<label  style="color:black;" for="nama_pkt">Nama</label>
								<input class="form-control <?php echo form_error('nama_pkt') ? 'is-invalid':'' ?>"
								 type="text" name="nama_pkt" placeholder="nama hama penyakit" value="<?php echo $penyakit->nama_pkt ?>" />
								 <?= form_error('nama_pkt' , "<small class='text-danger pl-3'>",'</small>'); ?> 
							</div>

							<!-- <div class="form-group">
								<label  style="color:black;" for="jenis">Jenis</label>
								<input class="form-control <?php echo form_error('jenis') ? 'is-invalid':'' ?>"
								 type="text" name="jenis" min="0" placeholder="jenis" value="<?php echo $penyakit->jenis?>" />
								<div class="invalid-feedback">
									<?php echo form_error('jenis') ?>
								</div>
							</div> -->

							<div class="form-group">
								<label style="color:black;" for="jenis">Jenis*</label>
								<select required class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" id=""  name="jenis">
								<option value="">-- Pilih nilai jenis --</option>
								<option <?=  $penyakit->jenis == 'hama' ? 'selected' : ''?> value="hama">hama</option>
								<option <?=  $penyakit->jenis == 'penyakit' ? 'selected' : ''?> value="penyakit">penyakit</option>
							
								</select>
							</div>
			

							<div class="form-group">
								<label  style="color:black;" for="solusi">Solusi</label>
								<textarea class="form-control <?php echo form_error('solusi') ? 'is-invalid':'' ?>"
								 name="solusi" placeholder="solusi..."><?php echo $penyakit->solusi ?></textarea>
								 <?= form_error('solusi' , "<small class='text-danger pl-3'>",'</small>'); ?> 
							</div>

							<input class="btn btn-success" type="submit" name="btn" value="Simpan" />
						</form>

					</div>

					<div class="card-footer small text-muted">
						* Pastikan data yang diubah sesuai 
					</div>


				</div>
				<!-- /.container-fluid -->

				<!-- Sticky Footer -->
				

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->

       

</body>
</div>
</html>