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

						<a href="<?php echo site_url('Gejala') ?>"><i class="fas fa-arrow-left"></i>
							Kembali</a>
					</div>
					<div class="card-body">

						<form action="" method="post" enctype="multipart/form-data">
						<!-- Note: atribut action dikosongkan, artinya action-nya akan diproses 
							oleh controller tempat vuew ini digunakan. Yakni index.php/admin/products/edit/ID --->

							<input type="hidden" name="id" value="<?php echo $gejala->kode?>" />

							<div class="form-group">
								<label  style="color:black;" for="kode">Kode*</label>
								<p style="color:black;" class=" <?php echo form_error('kode') ? 'is-invalid':'' ?>"
								type="text" name="kode" placeholder="kode" value="" > <?php echo $gejala->kode ?> </p>
								<div class="invalid-feedback">
									<?php echo form_error('kode') ?>
								</div>
							</div>
							

							<div class="form-group">
								<label  style="color:black;" for="nama_gjl">Nama Gejala*</label>
								<input style="color:black;" class="form-control <?php echo form_error('nama_gjl') ? 'is-invalid':'' ?>"
								 type="text" name="nama_gjl" min="0" placeholder="nama gejala" value="<?php echo $gejala->nama_gjl?>" />
								 <?= form_error('nama_gjl' , "<small class='text-danger pl-3'>",'</small>'); ?> 
							</div>

							<input class="btn btn-success" type="submit" name="btn" value="Simpan" />
						</form>

					</div>

					<div class="card-footer small text-muted">
						* Data tidak boleh kosong
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