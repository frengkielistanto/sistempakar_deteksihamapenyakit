<!DOCTYPE html>
<html lang="en">
	
	<!-- bootstrap -->
	<!-- <link rel="stylesheet" href="http://[::1]/tes/assets/css/bootstrap.min.css"> -->
	<!-- icon -->
	<!-- <link rel="stylesheet" href="http://[::1]/tes/assets/css/all.css"> -->
	<!-- custom -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css') ?>">
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

                
		<?php if ( $check==FALSE ): ?>
			<section class="col row m-0">

					<div class="col my-auto">
						<h1 class="display-4 text-center text-uppercase">pemberitahuan !!!</h1>
						<blockquote class="blockquote text-center">
							<p class="mb-0">Sistem konsultasi belum siap! Tidak ditemukan data gejala untuk memulai sesi konsultasi.</p>
							<footer class="blockquote-footer bg-transparent">Oleh <cite title="Source Title">Admin</cite></footer>
						</blockquote>
					</div>

			</section>


		<?php else: ?>
			<section class="col bg-darkcream">

			<?php
			$att = array(
				'class' => 'container col-sm-8 mx-auto row justify-content-center my-4',
			);
			echo form_open('Konsultasi/Hasil',$att);
			unset($att);
			?>
			<?php foreach ($gejala as $no => [ 'id'=>$id,  'nama_gjl'=>$gjl ]): ?>
				<div class="col p-4 bg-white">
					<dl class="row">
						<!-- <dt class="col-sm-3 teks">Kode</dt>
						<dd class="col-sm-9 teks"><?php echo $kode ?></dd> -->

						<div class="w-100"></div>

						<dt class="col-sm-3 teks">Nama</dt>
						<dd class="col-sm-9 teks" ><?php echo $gjl ?></dd>

						<div class="w-100"></div>

						<dt class="col-sm-3 teks">Pilihan Anda</dt>
						<dd class="col-sm-9">
							<dl class="row my-1">
								<!-- <dt class="col-auto my-auto text-uppercase teks">tidak</dt> -->
								<dd class="col-auto my-auto">
									<label class="switch my-auto">
									 <?php echo form_checkbox('pilihan[]', $id, FALSE) ?>
										<span class="slider round fas fa-check-circle text-primary text-center"></span>
									</label>
								</dd>
								<!-- <dt class="col-auto my-auto text-uppercase teks">ya</dt> -->
							</dl>
						</dd>
					</dl>
				</div>

				<div class="w-100 mb-4"></div>
				<?php endforeach; ?>

				<?php
				if (isset($att)) unset($att);

				$att = array(
					'name'          => 'submit',
	       			'id'            => 'submit',
					'class'			=> 'btn btn-block btn-outline-dark my-1',
					'type'          => 'submit',
					'content'       => 'Hitung'
				);
				?>
				<div class="col p-0">
					<?php echo form_button($att); ?>
				</div>

				<?php echo form_close() ?>
			</section>
		<?php endif; ?>
<!-- jquery -->

<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<!-- bootstrap -->
<!-- <script src="http://[::1]/tes/assets/js/bootstrap.bundle.min.js"></script> -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
