
<div class="container mt-5" style="margin-top:150px!important">
    <div class="container-fluid">
        <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
        <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-4 bg-dark text-light">
            <form name="form-container" method="post" action="<?php echo base_url().'daftar/tambah_aksi'; ?>" onsubmit="return validateForm()">
                <h4 class="text-center font-weight-bold"> Sign-Up </h4>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="password">
                </div>
               
                <button type="submit" class="btn btn-primary btn-block">Register</button>
                <div class="form-footer mt-2">
                    <p> Sudah punya akun? <a href="<?php echo base_url('login')?>">Login</a></p>
                </div>
            </form>
            
        </div>
        </div>
    </div>
 </div>
 <script>
        function validateForm() {
            if (document.forms["form-container"]["nama"].value == "") {
                alert("Nama Tidak Boleh Kosong");
                document.forms["form-container"]["nama"].focus();
                return false;
            }
            if (document.forms["form-container"]["username"].value == "") {
                alert("username Tidak Boleh Kosong");
                document.forms["form-container"]["username"].focus();
                return false;
            }
            if (document.forms["formPendaftaran"]["password"].selectedIndex < 1) {
                alert("password tidak boleh kosong.");
                document.forms["formPendaftaran"]["jpassword"].focus();
                return false;
            }
        }
    </script>
   