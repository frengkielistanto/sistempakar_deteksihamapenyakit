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
						<a href="<?php echo site_url('Penyakit/add') ?>"><i class="fas fa-plus"></i> tambah data hama dan penyakit</a>
						<!-- <?php echo form_open('Penyakit/search') ?>
							<input type="text" name="keyword" placeholder="Masukan kata kunci">
							<input type="submit" name="search_submit" class="btn btn-primary" value="Cari">
						<?php echo form_close() ?> -->
					</div>
					<div class="card-body">
						
						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
                                    <th>No</th>
                                    <th>Kode</th>
										<th>Nama</th>
										<th>Jenis</th>
										<th>Solusi</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                <?php $no = 1;
                                 foreach ($penyakit as $hp) { ?>
									
									<tr>
                                    <td width="20"><?= $no++; ?></td>

                                   		 <td width="150">
											<?php echo $hp->kode ?>
										</td>
										<td >
											<?php echo $hp->nama_pkt ?>
										</td>
										<td>
											<?php echo $hp->jenis ?>
										</td>
										<td class="small">
											<?php echo substr($hp->solusi, 0, 120) ?>...</td>
										<td width="250">
											<a href="<?php echo site_url('Penyakit/edit/'.$hp->kode) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<a onclick="deleteConfirm('<?php echo site_url('Penyakit/delete/'.$hp->kode) ?>')"
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

