<div class="container mt-5" style="margin-top:150px!important">
    <div class="container-fluid">
      
    <div class="row justify-content-center">  
        <div class="col-12 col-sm-6 col-md-4 bg-dark text-light ">
            <form action="<?php echo base_url(); ?>login/cek" method="post">
              <div class="text-center">
                <!-- Ini untuk konfirmasi Login -->
                <!-- <?php if(isset($error)) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Login Gagal</strong> Email atau Password Salah.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?> -->
                <h1>Login</h1>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <button type="submit" class="btn btn-primary mb-3" name="login">Login</button>
            </form>
            <!-- <div align="center">
              <p>Belum Punya Akun?</p>
              <a href="<?php echo base_url('daftar')?>"><button class="btn btn-danger">Register</button></a><br><br>
            </div> -->
        
          </div>
        
    </div>
    </div>
</body>