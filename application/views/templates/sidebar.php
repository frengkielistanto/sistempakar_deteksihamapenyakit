<body>
	<!--header-->
	<header id="site-header" class="fixed-top">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark stroke">
				<h1>
					<!-- <a class="navbar-brand" href="index.html">
						Sistem Pakar </br>
					</a> -->
				</h1>
				<!-- if logo is image enable this   
          <a class="navbar-brand" href="#index.html">
              <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
          </a> -->
				<button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
					<span class="navbar-toggler-icon fa icon-close fa-times"></span>
					</span>
				</button>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
					<ul class="navbar-nav ml-lg-auto">
						<li class="nav-item active">
							<a class="nav-link" href="<?php echo base_url('dashboard') ?>">Dashboard <span class="sr-only">(current)</span></a>
						</li>
						<?php if (is_logged()) : ?>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('penyakit') ?>">Hama dan Penyakit</a>
							</li>
                            <li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('gejala') ?>">Gejala</a>
							</li>
                            <li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('aturan') ?>">Gabungan</a>
							</li>
							<!-- <li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('konsultasi') ?>">Konsultasi</a>
							</li> -->
							<li class="nav-item mr-lg-1">
								<a class="nav-link" href="<?php echo base_url('ganti_pwd') ?>">Ganti Password</a>
							</li>
                            <li class="nav-item mr-lg-1">
								<a class="nav-link" href="#">Hai, <?= users()['nama'] ?></a>
							</li>
							<li class="nav-item mr-lg-1">
								<a class="nav-link" href="<?php echo base_url('logout') ?>">Logout</a>
							</li>
						<?php else : ?>
							<li class="nav-item mr-lg-1">
								<a class="nav-link" href="<?php echo base_url('login') ?>">Login</a>
							</li>
						<?php endif ?>
							
							
							
					
						
					</ul>


				</div>


				<!-- toggle switch for light and dark theme -->
				<!-- <div class="mobile-position">
					<nav class="navigation">
						<div class="theme-switch-wrapper">
							<label class="theme-switch" for="checkbox">
								<input type="checkbox" id="checkbox">
								<div class="mode-container py-1">
									<i class="gg-sun"></i>
									<i class="gg-moon"></i>
								</div>
							</label>
						</div>
					</nav>
				</div> -->
				<!-- //toggle switch for light and dark theme -->
			</nav>

		</div>
	</header>
