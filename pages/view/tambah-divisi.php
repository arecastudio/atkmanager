<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Tambah Divisi</h3>
  </div>
  <div class="panel-body">
  	<form method="post" action="" id="form">
  		<div class="input-group">
		  <span class="input-group-addon">Nama</span>
		  <input type="text" name="nama" id="kode_pum2" class="form-control" placeholder="Input nama divisi/bidang" />
		</div>	
		<div class="input-group">
		  <span class="input-group-addon">Keterangan</span>
		  <input type="text" name="ket" class="form-control" placeholder="Input keterangan tambahan" />
		</div>
    <div class="input-group">
      <span class="input-group-addon">Manager</span>
      <select name="manager" class="form-control">
        <option value="">Kosongkan</option>
        <?php
        $sql="SELECT nik,nama FROM user ORDER by nama ASC";
        $stmt=$conn->prepare($sql);
        if ($stmt->execute()) {
          $result = $stmt->get_result();
          while ($row = $result->fetch_row()){
            echo "
            <option value=\"$row[0]\">$row[0] - $row[1]</option>
            ";
          }
        }
        ?>
      </select>
    </div>

<center>
    <p class="hasil-submit" style="font-weight: bold;color: #00f;padding: 10px;"></p>
</center>
		<center>
		<div class="btn-group" role="group" aria-label="...">
		  <a href="?ref=divisi" class="btn btn-warning btn-lg">Kembali</a>
		  <button type="button" id="submit" class="btn btn-primary btn-lg">Simpan</button>
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
        url: 'pages/model/tambah-divisi-simpan.php',
        data: $('#form').serialize(),
        success: function (response) {
            /*$('#myModal').modal('show');*/
            $(".hasil-submit").html(response);
        }
      });
    });  
});
</script>