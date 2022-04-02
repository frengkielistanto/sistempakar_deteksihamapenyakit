<!DOCTYPE html>
<html lang="en">
<div class="container mt-5" style="margin-top:150px!important">
<body id="page-top">
	<div id="wrapper">
    <div id="content-wrapper">
    <div class="container-fluid">


				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('Aturan/add') ?>"><i class="fas fa-plus"></i> tambah data aturan</a>
					</div>
					<div class="card-body">
					<p style="color:black;" class=" mt-3  mb-3"> cf = ukuran kepastian terhadap fakta </p>
					<p style="color:black;">sangat yakin = 1, yakin = 0.8, cukup yakin = 0.6, sedikit yakin = 0.4, tidak tahu = 0.2, tidak = 0</p> 
						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
                                    <th>id</th>
                                    <th>Nama Gejala</th>
										<th>Nama Hama dan Penyakit</th>
										<th>cf</th>
										
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                <?php $no = 1;
								$arraycf=[
									'1.00'=>'sangat yakin',
									'0.80'=>'yakin',
									'0.60'=>'cukup yakin',
									'0.40'=>'sedikit yakin',
									'0.20'=>'tidak tahu',
									'0.00'=>'tidak'
								];
                                 foreach ($join_info_gejala_info_penyakit as $jgp) { ?>
									
									<tr>
                                    <td width="20"><?= $no++; ?></td>

                                   		 <td >
											<?php echo $jgp->nama_gjl ?>
										</td>
										<td width="150">
											<?php echo $jgp->nama_pkt ?>
										</td>
										<td>
											<?php echo $jgp->cf.' ('.$arraycf[$jgp->cf].')'?>
										</td>
										
								
									
										<td width="250">
											<a href="<?php echo site_url('Aturan/edit/'.$jgp->id) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<a onclick="deleteConfirm('<?php echo site_url('Aturan/delete/'.$jgp->id) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
										</td>
                                        
									</tr>
									<?php } ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	

	<script>
	function deleteConfirm(url){
		$('#btn-delete').attr('href', url);
		$('#deleteModal').modal();
	}
	</script>
    <!-- Logout Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div style="color:black;" class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
      </div>
    </div>
  </div>
</div>
</body>
</div>

</html>

