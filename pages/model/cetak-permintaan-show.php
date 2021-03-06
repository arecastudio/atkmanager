<?php
require_once('../inc.php');
$conn=new mysqli(HOST,USER,PASS,DB);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ( isset($_POST['tgl1']) && isset($_POST['tgl2']) ) {
	$tgl1=$_POST['tgl1'];$tgl1=trim($tgl1);
	$tgl2=$_POST['tgl2'];$gsl2=trim($tgl2);
	if(strlen($tgl1)>0 && strlen($tgl2)>0){
		$i=0;
		#$sql="SELECT nomor,alasan,status,tgl,nik FROM permintaan WHERE (date(tgl) BETWEEN ? AND ?) ORDER BY tgl ASC";
		$sql="SELECT DISTINCT p.nomor,p.alasan,p.status,DATE_FORMAT(p.tgl, '%d %M %Y'),d.nama,p.nik,u.nama,m.nik,m.nama FROM permintaan AS p LEFT OUTER JOIN user AS u ON u.nik=p.nik LEFT OUTER JOIN divisi AS d ON d.id=u.id_divisi LEFT OUTER JOIN user AS m ON m.nik=d.nik_manager WHERE  (p.tgl BETWEEN ? AND ?) ORDER BY p.tgl ASC;";

		$stmt=$conn->prepare($sql);
		$stmt->bind_param('ss',$tgl1,$tgl2);
		if($stmt->execute()){
			echo "
			<div class=\"table-responsive\">
			<table class=\"table table-hover table-bordered\">
			<thead>
				<tr>
					<th>#</th>
					<th>Nomor</th>
					<th>Keterangan</th>
					<th>Tgl. Posting</th>
					<th>Divisi</th>
					<th>Status</th>
					<th>Kontrol</th>
				</tr>
			</thead>
			<tbody>
			";
			$result=$stmt->get_result();
			while($row=$result->fetch_row()){
				$i++;
				echo "
				<tr valign=\"middle\">
					<td>$i</td>
					<td><a href=\"?ref=detail-permintaan&id=$row[0]&back=cetak-permintaan\" title=\"Lihat detail...\"><strong>$row[0]</strong></a></td>
					<td>$row[1]</td>
					<td align=\"center\">$row[3]</td>
					<td align=\"center\">$row[4]</td>
					<td align=\"center\"><b class=\"label label-primary\">".get_status($row[2])."</b></td>
					<td align=\"center\" title=\"Cetak\">";
?>
                                                 <form method="post" target="_blank" action="<?php echo base_url()."pages/reports/cetak-permintaan.php";?>" >
                                                         <input type="hidden" name="nomor" value="<?php echo $row[0];?>" />
                                                         <input type="hidden" name="ket" value="<?php echo $row[1];?>" />
                                                         <input type="hidden" name="tgl" value="<?php echo $row[3];?>" />
                                                         <input type="hidden" name="div" value="<?php echo $row[4];?>" />
                                                         <input type="hidden" name="nik1" value="<?php echo $row[5];?>" />
                                                         <input type="hidden" name="nama1" value="<?php echo $row[6];?>" />
                                                         <input type="hidden" name="nik2" value="<?php echo $row[7];?>" />
                                                         <input type="hidden" name="nama2" value="<?php echo $row[8];?>" />
                                                         <button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-print"></span></button>
                                                 </form>

<?php
				echo "</td>
				</tr>
				";
			}
			echo "
			</tbody>
			</table>
			</div>";
		}
	}
}
?>
