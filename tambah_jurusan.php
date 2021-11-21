<!DOCTYPE html>
<?php
include 'koneksi.php';
?>
<html>
<head>
	<title>Tambah Prodi</title>
</head>
<body>
	<form method="POST">
	<table border="0" width="50%" align="center">
		<tr>
			<td width="25%">Nama Prodi</td>
			<td width="75%"><input type="text" name="prodi" size="40" placeholder="Nama Prodi" required=""></td>
		</tr>
		<tr>
			<td width="25%">Nama Jurusan
				<select name="jurusan">
					<?php 
						$qry = "SELECT * FROM jurusan";
						$result = mysqli_query($konek,$qry);
						while($row=mysqli_fetch_row($result))
						{
							echo "<option value = '$row[0]'>$row[1]</option>";
						}
					?>
				</select>
			</td>
			
		</tr>
		<tr>
			<td width="25%"></td>
			<td width="75%"><input type="submit" name="save" value="simpan"></td>
		</tr>
	</table> 
	</form>
<?php
if(isset($_POST['save']))
{
	$jurusan=$_POST['jurusan'];
	$prodi = $_POST['prodi'];
	$sql="INSERT INTO prodi(nama_prodi,id_jurusan) values ('$prodi',$jurusan)";
	$hasil=mysqli_query($konek,$sql);
	if($hasil)
		echo"<script language='javascript'>
		(window.alert('Data Tersimpan'))
		location.href='table_prodi.php'
		</script>";
	else
		echo"<script language='javascript'>
		(window.alert('Data Tidak Dapat Tersimpan'))
		location.href='tambah_jurusan.php'
		</script>";
}
?>
</body>
</html>