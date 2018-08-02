	<!-- jQuery 3 -->
	<script src="<?= base_url()?>assets/bootstrap/js/jquery.min.js"></script>
	<script>
		$(function()
		{
			$('#showData').click(function()
			{
				$("#kel").removeClass('hide');
				$('#showData').hide();
				$('#hideData').show();
			});

			$('#hideData').click(function()
			{
				$('#kel').addClass('hide');
				$('#hideData').hide();
				$('#showData').show();
			});
		$('#hideData').hide();
	});
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Surat Keterangan Tidak Mampu</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_desa/about')?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?= site_url('surat')?>"> Daftar Cetak Surat</a></li>
			<li class="active">Surat Keterangan Tidak Mampu</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?=site_url("surat")?>" class="btn btn-social btn-flat btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Kembali Ke Daftar Wilayah">
							<i class="fa fa-arrow-circle-left "></i>Kembali Ke Daftar Cetak Surat
           	</a>
					</div>
					<div class="box-body">
						<form action="" id="main" name="main" method="POST" class="form-horizontal">
							<div class="form-group">
								<label for="nik"  class="col-sm-3 control-label">NIK / Nama</label>
								<div class="col-sm-6 col-lg-4">
									<select class="form-control  input-sm select2" id="nik" name="nik" style ="width:100%;" onchange="formAction('main')">
										<option value="">--  Cari NIK / Nama Penduduk--</option>
										<?php foreach ($penduduk as $data):?>
											<option value="<?= $data['id']?>" <?php if ($individu['nik']==$data['nik']):?>selected<?php endif;?>>NIK : <?= $data['nik']." - ".$data['nama']?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
						</form>
						<form id="validasi" action="<?= $form_action?>" method="POST" target="_blank" class="form-horizontal">
							<div class="row jar_form">
								<label for="nomor" class="col-sm-3"></label>
								<div class="col-sm-8">
									<input class="required" type="hidden" name="nik" value="<?= $individu['id']?>">
								</div>
							</div>
							<?php if ($individu):?>
								<?php include("donjo-app/views/surat/form/konfirmasi_pemohon.php"); ?>
								<div class="form-group">
								<label for="keperluan"  class="col-sm-3 control-label">Data Keluarga / KK</label>
								<div class="col-sm-8">
									<a id="showData" class="btn btn-social btn-flat btn-danger btn-sm"><i class="fa fa-search-plus"></i> Tampilkan</a>
									<a id="hideData" class="btn btn-social btn-flat btn-danger btn-sm"><i class="fa fa-search-minus"></i> Sembunyikan</a>
								</div>
							</div>
							<div id="kel" class="form-group hide">
								<label for="pengikut"  class="col-sm-3 control-label">Keluarga</label>
								<div class="col-sm-8">
									<div class="table-responsive">
										<table class="table table-bordered dataTable table-hover nowrap">
											<thead class="bg-gray disabled color-palette">
												<tr>
													<th>No</th>
													<th>NIK</th>
													<th>Nama</th>
													<th>Jenis Kelamin</th>
													<th>Tempat Tanggal Lahir</th>
													<th>Hubungan</th>
													<th>Status Kawin</th>
												</tr>
											</thead>
											<tbody>
												<?php if ($anggota!=NULL):
													$i=0;?>
													<?php foreach ($anggota AS $data): $i++;?>
														<tr>
															<td><?= $i?></td>
															<td><?= $data['nik']?></td>
															<td><?= unpenetration($data['nama'])?></td>
															<td><?= $data['sex']?></td>
															<td><?= $data['tempatlahir']?>, <?= tgl_indo($data['tanggallahir'])?></td>
															<td><?= $data['hubungan']?></td>
															<td><?= $data['status_kawin']?></td>
															</tr>
													<?php endforeach;?>
												<?php endif;?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php	endif;?>
							<div class="form-group">
								<label for="nomor"  class="col-sm-3 control-label">Nomor Surat</label>
								<div class="col-sm-8">
									<input  id="nomor" class="form-control input-sm required" type="text" placeholder="Nomor Surat" name="nomor">
									<p class="help-block text-red small">Terakhir: <strong><?= $surat_terakhir['no_surat'];?></strong> (tgl: <?= $surat_terakhir['tanggal']?>)</p>
								</div>
							</div>
							<div class="form-group">
								<label for="keperluan"  class="col-sm-3 control-label">Keperluan</label>
								<div class="col-sm-8">
									<textarea name="keperluan" class="form-control input-sm required" placeholder="Keperluan"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Tertanda Atas Nama</label>
								<div class="col-sm-6 col-lg-4">
									<select class="form-control input-sm" name="atas_nama">
										<option value="">Atas Nama</option>
										<option value="An. Kepala Desa <?= unpenetration($desa['nama_desa'])?>"> An. Kepala Desa <?= unpenetration($desa['nama_desa'])?> </option>
										<option value="Ub. Kepala Desa <?= unpenetration($desa['nama_desa'])?>"> Ub. Kepala Desa <?= unpenetration($desa['nama_desa'])?> </option>
									</select>
								</div>
							</div>
							<?php include("donjo-app/views/surat/form/_pamong.php"); ?>
						</form>
					</div>
					<div class="box-footer">
						<div class="row">
							<div class="col-xs-12">
								<button type="reset" class="btn btn-social btn-flat btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
								<button type="button" onclick="$('#'+'validasi').attr('action','<?= $form_action?>');$('#'+'validasi').submit();" class="btn btn-social btn-flat btn-info btn-sm pull-right"><i class="fa fa-print"></i> Cetak</button>
								<?php if (SuratExport($url)):?>
									<button type="button" onclick="$('#'+'validasi').attr('action','<?= $form_action2?>');$('#'+'validasi').submit();" class="btn btn-social btn-flat btn-success btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-file-text"></i> Ekspor Dok</button>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
