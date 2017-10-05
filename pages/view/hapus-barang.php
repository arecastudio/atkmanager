<?php
if (isset($_GET['id']) 
	&& isset($_GET['nama']) 
	&& isset($_GET['satuan']) 
	&& isset($_GET['stok'])  
	&& isset($_GET['ket'])) {

	$id=trim($_GET['id']);
	$nama=trim($_GET['nama']);
	$satuan=trim($_GET['satuan']);
	$stok=trim($_GET['stok']);
	$ket=trim($_GET['ket']);


?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Hapus Barang</h3>
  </div>
  <div class="panel-body">
  <h3>Yakin untuk hapus barang ini ?</h3>
  	<form method="post" action="" id="form-hapus-barang">
  		<input type="hidden" name="id" value="<?php echo $id;?>" />
  		<div class="input-group">
		  <span class="input-group-addon">Nama Barang</span>
		  <input type="text" readonly name="nama" id="kode_pum2" class="form-control" placeholder="Input nama barang" value="<?php echo $nama;?>" />
		</div>
		<div class="input-group">
		  <span class="input-group-addon">Stok</span>
		  <input type="text" readonly name="stok" class="form-control" placeholder="Input jumlah stok" value="<?php echo $stok;?>" />
		</div>
		<div class="input-group">
		  <span class="input-group-addon">Satuan</span>
		  <input type="text" readonly name="satuan" class="form-control" placeholder="Input satuan" value="<?php echo $satuan;?>" />
		</div>		
		<div class="input-group">
		  <span class="input-group-addon">Keterangan</span>
		  <input type="text" readonly name="ket" class="form-control" placeholder="Input keterangan tambahan" value="<?php echo $ket;?>" />
		</div>

<center>
    <p class="hasil-submit" style=""></p>
</center>
		<center>
		<div class="btn-group" role="group" aria-label="...">
		  <a href="?ref=barang" class="btn btn-warning btn-lg">Kembali</a>
		  <button type="button" id="submit" class="btn btn-primary btn-lg">Hapus</button>
		</div>
		</center>
  	</form>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $('#submit').click(function(){
      $.ajax({
        type: 'post',
        url: 'pages/model/hapus-barang-simpan.php',
        data: $('#form-hapus-barang').serialize(),
        success: function (response) {
            /*$('#myModal').modal('show');*/
            $(".hasil-submit").html(response);
        }
      });
    });  
});
</script>

<?php
}
?>