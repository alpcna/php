<html>
<head>
	<meta charset="utf-8">
	<title>PHP Örneğimiz</title>
</head>
<body>

	<h1>PHP Çalışıyoruz</h1>
	
	<?php
		if (isset($_GET["id"])) {
			$id = $_GET["id"];
			echo "<h3>ID Değişkeni: <b>{$id}</b></h3>";
			echo sprintf("<h3>ID Değişkeni: <b>%s</b></h3>", $id);
		} else {
			echo "<h3>ID Değişkeni bulunamadı.</h3>";
		}

		if (isset($_GET["ad"])) {
			$ad = $_GET["ad"];
			echo sprintf("<h3>AD Değişkeni: <b>%s</b></h3>", $ad);
		} else {
			echo "<h3>AD Değişkeni bulunamadı.</h3>";
		}

		if (isset($_GET["soyad"])) {
			$soyad = $_GET["soyad"];
			echo sprintf("<h3>Soyad Değişkeni: <b>%s</b></h3>", $soyad);
		} else {
			echo "<h3>Soyad Değişkeni bulunamadı.</h3>";
		}
	?>

</body>
</html>