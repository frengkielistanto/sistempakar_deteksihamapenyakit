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

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('Aturan') ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
					</div>
					<div class="card-body">

						<form action="<?php echo site_url('Aturan/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="form-group">
								<label style="color:black;" for="nama_gjl">Nama Gejala*</label>
								
								<select required class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" id=""  name="gejala_id">
								<option value="">-- Pilih gejala --</option>
									<?php foreach ($gejala as $key => $value) { ?>
										<option value="<?=$value->id?>"><?=$value->nama_gjl?></option>
									<?php } ?>
								</select>
							</div>
							
							
							<div class="form-group">
								<label style="color:black;" for="nama_pkt">Nama Hama dan Penyakit*</label>
								<select required class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" id=""  name="penyakit_id">
								<option value="">-- Pilih penyakit --</option>
									<?php foreach ($penyakit as $key => $value) { ?>
										<option value="<?=$value->id?>"><?=$value->nama_pkt?></option>
									<?php } ?>
								</select>
							</div>

							<div class="form-group">
								<label style="color:black;" for="cf">cf* ukuran kepastian terhadap fakta</label>
								<p style="color:black;">sangat yakin = 1, yakin = 0.8, cukup yakin = 0.6, sedikit yakin = 0.4, tidak tahu = 0.2, tidak = 0</p> <br>
								<select required class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" id=""  name="cf">
								<option value="">-- Pilih nilai cf --</option>
								<option value="1">sangat yakin</option>
								<option value="0.8">yakin</option>
								<option value="0.6">cukup yakin</option>
								<option value="0.4">sedikit yakin</option>
								<option value="0.2">tidak tahu</option>
								<option value="0">tidak</option>
								</select>
								<!-- <input style="color:black;" step="any" class="form-control <?php echo form_error('cf') ? 'is-invalid':'' ?>"
								 type="number" name="cf" min="0" placeholder="masukkan nilai cf" /> -->
								 <?= form_error('cf' , "<small class='text-danger pl-3'>",'</small>'); ?>
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