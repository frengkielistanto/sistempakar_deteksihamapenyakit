<div class="container mt-5" style="margin-top:150px!important">
    <div class="container-fluid">
      
    <div class="row justify-content-center">  
        <div class="col-12 col-sm-6 col-md-4 bg-dark text-light ">
        <form class="form-horizontal" action="<?php echo site_url('ganti_pwd/gantipwd'); ?>" method="post">
              
             
              <div class="card-body">
              <?php echo validation_errors('<div class="alert bg-danger" role="alert">', '</div>'); ?>

            <?php echo $this->session->flashdata('sukses'); ?>
              
             
                <div class="col-md-12">
               <div class="form-group">
                      <label for="exampleInputEmail1">Password Lama</label>
                      <input name="password" id="password" class="form-control" required autofocus type="password" value="">
                     
                      </div> 
                <div class="form-group">
                      <label for="exampleInputEmail1">Password Baru</label>
                      <input name="password_baru" id="password_baru" class="form-control" required type="password" value="">
                      
                      </div>
                <div class="form-group">
                      <label for="exampleInputPassword1">Konfirmasi Password</label>
                      <input name="ulangi" id="ulangi" class="form-control" required type="password" value="">
                      </div>
            
              </div>
              </div>
          
            
              
            <button type="submit" name="save" class="btn btn-primary mb-3">Simpan</button> 
            
              </form>
        
        
          </div>
        
    </div>
    </div>
</body>