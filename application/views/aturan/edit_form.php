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

						<a href="<?php echo site_url('aturan') ?>"><i class="fas fa-arrow-left"></i>
							Kembali</a>
					</div>
					<div class="card-body">

						<form action="" method="post" enctype="multipart/form-data">
						<!-- Note: atribut action dikosongkan, artinya action-nya akan diproses 
							oleh controller tempat vuew ini digunakan. Yakni index.php/admin/products/edit/ID --->

							<input type="hidden" name="id" value="<?php echo $aturan->id?>" />
							<div class="form-group">
								<label style="color:black;" for="nama_gjl">Nama Gejala</label>
								
								<select required class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" id=""  name="gejala_id">
								<!-- <option value="<?php echo  $aturan->id ?>">-- Pilih gejala --</option> -->
									<?php foreach ($gejala as $key => $value) { ?>
										<option <?=  $aturan->gejala_id == $value->id ? 'selected' : ''?> value="<?=$value->id?>"><?=$value->nama_gjl?></option>
									<?php } ?>
								</select>
							</div>
							
							
							<div class="form-group">
								<label style="color:black;" for="nama_pkt">Nama Hama dan Penyakit</label>
								<select required class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" id=""  name="penyakit_id">
								<!-- <option value="<?php echo  $aturan->id ?>">-- Pilih penyakit --</option> -->
									<?php foreach ($penyakit as $key => $value) { ?>
										<option <?=  $aturan->penyakit_id == $value->id ? 'selected' : ''?> value="<?=$value->id?>"><?=$value->nama_pkt?></option>
									<?php } ?>
								</select>
							</div>

							<div class="form-group">
								<label style="color:black;" for="cf">cf*</label>
								<p style="color:black;">sangat yakin = 1, yakin = 0.8, cukup yakin = 0.6, sedikit yakin = 0.4, tidak tahu = 0.2, tidak = 0</p> <br>
								<select required class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" id=""  name="cf">
								<option value="">-- Pilih nilai cf --</option>
								<option <?=  $aturan->cf == 1 ? 'selected' : ''?> value="1">sangat yakin</option>
								<option <?=  $aturan->cf == 0.8 ? 'selected' : ''?> value="0.8">yakin</option>
								<option <?=  $aturan->cf == 0.6 ? 'selected' : ''?> value="0.6">cukup yakin</option>
								<option <?=  $aturan->cf == 0.4 ? 'selected' : ''?> value="0.4">sedikit yakin</option>
								<option <?=  $aturan->cf == 0.2 ? 'selected' : ''?> value="0.2">tidak tahu</option>
								<option <?=  $aturan->cf == 0 ? 'selected' : ''?> value="0">tidak</option>
								</select>
								 <?= form_error('cf' , "<small class='text-danger pl-3'>",'</small>'); ?>
							</div>

			
					
			

							

							<input class="btn btn-success" type="submit" name="btn" value="Simpan" />
						</form>

					</div>

					<div class="card-footer small text-muted">
						* Pastikan data terisi benar
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