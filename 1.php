<?php
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$isi = 'google-site-verification: '.$id;
	file_put_contents($id,$isi);
	echo 'verification file berhasil di generate';
}else{
	echo 'masukkan ID google webmaster verifikation<br/>Contoh format URL => http://domain.com/1.php?id=googlea30dd577a84719c1.html';
}

?>