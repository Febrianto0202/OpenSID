<style>
	.input-sm
	{
		padding: 4px 4px;
	}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Pemantauan Isolasi Mandiri Saat Pandemi Covid-19</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Data Pemudik</li>
		</ol>
	</section>
	
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-3">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title"><strong>Form Pemantauan</strong></h3>
						
					</div>
					<div class="box-body">
						<form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data">

							<input type="hidden" id="this_url" value="<?= $this_url ?>" >
							<input type="hidden" name="status_covid" id="status_covid" >
							<input type="hidden" id="page" name="page" value="<?= $page ?>" >

							<div class="form-group">
								<label for="nama">Data H+</label>
								<select class="form-control input-sm" name="data_h_plus" id="data_h_plus">
									<option>-- Semua Data --</option>
									<?php foreach ($select_h_plus as $id => $nama): ?>
									<option value="<?= $id?>" <?php selected($h_plus, $id); ?> > <?= strtoupper($nama)?> </option>
									<?php endforeach;?>
								</select>
								<small id="nama_msg" class="form-text text-muted"></small>
							</div>
							
							<div class="form-group">
								<label for="nama">NIK/Nama</label>
								<select class="form-control select2" id="terdata" name="terdata"  >
									<option value="">-- Silakan Masukan NIK / Nama--</option>
									<?php foreach ($pemudik_array as $item): ?>
									<option value="<?= $item['id']?>" data-statuscovid="<?= $item['status_covid']?>" > <?= $item['terdata_id']." - ".$item['nama']?></option>
									<?php endforeach; ?>
								</select>
								<small id="nama_msg" class="form-text text-muted"></small>
							</div>
						  	<div class="form-group">
						    	<label for="tgl_jam">Tanggal/Jam</label>
						    	<input type="text" class="form-control input-sm" name="tgl_jam" id="tgl_jam">
						    	<small id="tgl_jam_msg" class="form-text text-muted"></small>
						  	</div>
						  	<div class="form-group">
						    	<label for="suhu">Suhu Tubuh</label>
						    	<input type="text" class="form-control input-sm" name="suhu">
						    	<small id="suhu_msg" class="form-text text-muted"></small>
						  	</div>
						  	<div class="table-responsive-sm">
						  		<table class="table table-borderless table-sm">
								  	<thead>
								    	<tr>
								      		<th colspan="2" class="text-left">Centang jika mengalami kondisi berikut</th>
							    		</tr>
								  	</thead>
								  	<tbody>
								    	<tr>
								      		<td width="20%" class="text-center">
								      			<input type="checkbox" class="form-check-input" name="batuk">
								      		</td>
								      		<td>Batuk</td>
							    		</tr>
							    		<tr>
								      		<td width="20%" class="text-center">
								      			<input type="checkbox" class="form-check-input" name="flu">
								      		</td>
								      		<td>Flu</td>
							    		</tr>
							    		<tr>
								      		<td width="20%" class="text-center">
								      			<input type="checkbox" class="form-check-input" name="sesak">
								      		</td>
								      		<td>Sesak nafas</td>
							    		</tr>
									</tbody>
								</table>
							</div>
							<div class="form-group">
						    	<label for="keluhan">Keluhan Lain</label>
						    	<textarea name="keluhan" class="form-control input-sm" rows="2"></textarea>
						    	<small id="keluhan_msg" class="form-text text-muted"></small>
						  	</div>

						</form>
					</div>

					<div class="box-footer">
						<div class="box-tools pull-right">
							<button type="submit" class="btn btn-social btn-flat btn-info btn-sm pull-right" onclick="$('#'+'validasi').submit();"><i class="fa fa-check"></i> Simpan</button>
						</div>
			 	 	</div>

				</div>
			</div>
			<div class="col-md-9">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url("covid19/unduhsheet")?>" class="btn btn-social btn-flat bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh Data" target="_blank"><i class="fa fa-download"></i> Unduh</a>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<form id="mainform" name="mainform" action="" method="post">
										<div class="row">
											<div class="col-sm-12">
												<div class="table-responsive">
													<table class="table table-bordered dataTable table-striped table-hover">
														<thead class="bg-gray disabled color-palette">
															<tr>
																<th>No</th>
																<th>Aksi</th>
																<th>Tanggal/Jam</th>
																<th>NIK</th>
																<th>Nama</th>
																<th>Usia</th>
																<th>JK</th>
																<th>Suhu</th>
																<th>Batuk</th>
																<th>Flu</th>
																<th>Sesak</th>
																<th>Keluhan</th>
																<th>Status</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$nomer = $paging->offset;
															foreach ($pantau_pemudik_array as $key=>$item):
																$nomer++;
															?>
															<tr>
																<td align="center" width="2"><?= $nomer; ?></td>
																<td nowrap>
																	<?php if ($this->CI->cek_hak_akses('h')): ?>
																	<a href="#" data-href="<?= site_url("$url_delete_front/$item[id]/$url_delete_rare")?>" class="btn bg-maroon btn-flat btn-xs" title="Hapus Data" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																	<?php endif; ?>
																</td>
																<td><?= $item["tanggal_jam"] ?></td>
																<td><?= $item["nik"] ?></td>
																<td><?= $item["nama"] ?></td>
																<td><?= $item["umur"] ?></td>
																<td><?= $item["sex"] ?></td>
																<td><?= $item["suhu_tubuh"];?></td>
																<td><?= ($item["batuk"]==='1' ? 'Ya' : 'Tidak');?></td>
																<td><?= ($item["flu"]==='1' ? 'Ya' : 'Tidak');?></td>
																<td><?= ($item["sesak_nafas"]==='1' ? 'Ya' : 'Tidak');?></td>
																<td><?= $item["keluhan_lain"];?></td>
																<td><?= $item["status_covid"];?></td>
															</tr>
															<?php endforeach; ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</form>
									<div class="row">
										<div class="col-sm-6">
											<div class="dataTables_length">
												<form id="paging" action="" method="post" class="form-horizontal">
													<label>
														Tampilkan
														<select name="per_page" class="form-control input-sm" onchange="$('#paging').submit()">
															<option value="10" <?php selected($per_page,10); ?> >10</option>
															<option value="100" <?php selected($per_page,100); ?> >100</option>
															<option value="200" <?php selected($per_page,200); ?> >200</option>
														</select>
														Dari
														<strong><?= $paging->num_rows?></strong>
														Total Data
													</label>
												</form>
											</div>
										</div>
										<div class="col-sm-6">
					                      	<div class="dataTables_paginate paging_simple_numbers">
					                        	<ul class="pagination">
				                        		<?php if ($paging->start_link): ?>
						                            <li>
						                            	<a href="<?=site_url('covid19/pantau/'.$paging->start_link)?>" aria-label="First"><span aria-hidden="true">Awal</span></a>
						                            </li>
					                          	<?php endif; ?>

					                          	<?php if ($paging->prev): ?>
						                            <li>
						                            	<a href="<?=site_url('covid19/pantau/'.$paging->prev)?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
						                            </li>
					                          	<?php endif; ?>

					                          	<?php for ($i=$paging->start_link;$i<=$paging->end_link;$i++): ?>
						               	            <li <?=jecho($p, $i, "class='active'")?>>
						               	            	<a href="<?= site_url('covid19/pantau/'.$i)?>"><?= $i?></a>
					               	            	</li>
					                          	<?php endfor; ?>

					                          	<?php if ($paging->next): ?>
						                            <li>
						                            	<a href="<?=site_url('covid19/pantau/'.$paging->next)?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
						                            </li>
					                          	<?php endif; ?>

					                          	<?php if ($paging->end_link): ?>
						                            <li>
						                            	<a href="<?=site_url('covid19/pantau/'.$paging->end_link)?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a>
						                            </li>
					                          	<?php endif; ?>
					                         
					                        	</ul>
					                     	 </div>
                    					</div>
                					</div>
                				</div>
                			</div>
                		</div>
                	</div>
				</div>
			</div>
		</div>
	</section>
</div>


<!-- MODAL DIALOG -->
<div class='modal fade' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
			</div>
			<div class='modal-body btn-info'>
				Apakah Anda yakin ingin menghapus data ini?
			</div>
			<div class='modal-footer'>
				<button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
				<a class='btn-ok'>
					<button type="button" class="btn btn-social btn-flat btn-danger btn-sm" id="ok-delete"><i class='fa fa-trash-o'></i> Hapus</button>
				</a>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function()
	{
		$("#data_h_plus").change(function() {
			url = $("#this_url").val()+"/"+$("#page").val()+"/"+($(this).val());
			$(location).attr('href',url);
		});

		$('#tgl_jam').datetimepicker(
		{
			format: 'YYYY-MM-DD LT',
		});

		$("#terdata").change(function() {
			$("#status_covid").val($(this).find(':selected').data('statuscovid'));
		});

	});
</script>