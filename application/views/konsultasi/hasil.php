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

                <section class="col bg-darkcream d-flex">
                <?php if ( $result == FALSE ): ?>
                    <section class="container row align-items-center justify-content-center bg-white mx-auto">
                        <div class="col-sm-7">
                            <h1 class="display-4 text-center text-uppercase ">Mohon Maaf!</h1>
                            <blockquote class="blockquote text-center">
                                <p class="mb-0">Kami tidak dapat mengambil keputusan atas pilihan anda. Berikan gejala yang lebih rinci untuk mendapatkan hasil yang maksimal.</p>
                                <footer class="blockquote-footer bg-transparent">Oleh <cite title="Source Title">Admin</cite></footer>
                            </blockquote>
                        </div>
                    </section>
                <?php else: ?>
				<section class="container">
					<?php foreach ($result as ['info' => $info, 'hasil' => $hasil]): ?>

						<dl class="row p-5 bg-white my-3 teks">
							<dt style="color:black;" class="col-sm-3 teks">Nama </dt>
							<dd style="color:black;" class="col-sm-9 teks"><?php echo end($info)['penyakit_nama'] ?></dd>
							
							<div class="w-100"></div>

							<dt style="color:black;" class="col-sm-3 teks">Jenis</dt>
							<dd style="color:black;" class="col-sm-9 teks"><?php echo end($info)['penyakit_jenis']; ?></dd>

							<div class="w-100"></div>

							<dt style="color:black;" class="col-sm-3 teks">Presentase</dt>
							<dd style="color:black;" class="col-sm-9 teks"><?php echo str_replace(".",',',$hasil)."\n%"; ?></dd>

							<div class="w-100"></div>

							<dt style="color:black;" class="col-sm-3">Gejala</dt>
							<dd class="col-sm-9">
								<dl class="row my-0">
									<dd class="col-sm-12 text-muted text-capitalize">gejala pilihan ditandai dengan warna hijau</dd>
								</dl>
								<?php foreach ($info as ['gejala_id' => $gejalaId, 'gejala_kode'=> $gejalaKode, 'gejala_nama' => $gejalaNama]): ?>

									<?php echo in_array($gejalaId, $pilihan) ? '<dl class="row mx-1 text-primary my-0">' : '<dl class="row mx-1 my-0">'; ?>
										<dt class="col-sm-3">Kode <?php echo $gejalaKode ?></dt>
										<dd class="col-sm-9"><?php echo $gejalaNama ?></dd>
									</dl>

									<?php unset($gejalaId, $gejalaKode, $gejalaNama) ?>
									<?php endforeach; ?>
							</dd>
							<dt style="color:black;" class="col-sm-3 text-truncate">Solusi</dt>
							<dd style="color:black;" class="col-sm-9"><?php echo end($info)['penyakit_solusi'] ?></dd>
						</dl>
					<?php endforeach; ?>
				</section>
			<?php endif; ?>
	</section>
