<?php
$jml_pilih=0;
if (isset($_SESSION['jml_pilih'])) {
	$jml_pilih=$_SESSION['jml_pilih'];
}else{
	//
}

if (isset($_POST['submit'])) {
	$id=$_POST['hidden_id'];
	$jml=$_POST['text_jml'];$jml=trim($jml);
	if (strlen($jml)>0 && strval($jml)>0) {
		$jml=strval($jml);
		#echo $jml;
	}
}

?>
<div class="panel panel-default">
  <div class="panel-body">
    <ul class="nav nav-tabs">
	  <li role="presentation" class="active"><a href="#">Pilih Item</a></li>
	  <li role="presentation"><a href="?ref=ajukan-permintaan">Ajukan Permintaan <span class="badge"><?php echo $jml_pilih;?></span></a></li>
	</ul>
	<br/>

<div class="input-group">
  <input type="text" class="form-control" placeholder="Masukkan nama barang" aria-describedby="basic-addon2">
  <span class="input-group-addon" id="basic-addon2">Pencarian</span>
</div>

	<div class="tab-content">
	<div class="row">
	<?php

	$i=1;
	$sql="SELECT id, nama, satuan, stok, ket, jenis, max, min, harga, img FROM barang ORDER BY nama ASC;";

	$stmt=$conn->prepare($sql);
	if ($stmt->execute()) {
		$result = $stmt->get_result();
        while ($row = $result->fetch_row()){
	?>

  <div class="col-xs-6 col-md-3">
    <div class="thumbnail">
      <img src="assets/img/item/<?php echo $row[9];?>" alt="<?php echo $row[1];?>" class="img-item" />
      <div class="caption">
        <span class="label-judul"><?php echo ucwords($row[1]);?></span>
        <form method="post" action="">
        	<input type="hidden" name="hidden_id" value="<?php echo $row[0];?>" />
        	<div class="input-group">        		
        		<span class="input-group-addon" id="basic-addon1">Jumlah</span>
        		<input type="text" class="form-control" name="text_jml" value="1" size="5px" />
        	</div>
        	<button type="submit" name="submit" class="btn btn-warning"><span class="glyphicon glyphicon-shopping-cart"></span> Tambahkan</button>
        </form>
      </div>
    </div>
  </div>

	<?php
		}
	}

	?>
	</div>
	</div>
  </div>
</div>