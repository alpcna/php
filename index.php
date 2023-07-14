<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP Örneğimiz</title>
</head>
<body>

<?php if (!isset($_GET["id"])) { ?>

	<h1>Nuri'nin Teknoloji Bloğu...</h1>
	<ul>
		<?php
		require_once "admin/config.php";
		$pdo = new PDO("mysql:host=localhost;dbname=veritabani", "kullaniciadi", "sifre");
		$sql = "SELECT * FROM yazilar ORDER BY id DESC";
		$statement = $pdo->query($sql);
		$kayitlar = $statement->fetchAll(PDO::FETCH_ASSOC);

		foreach ($kayitlar as $kayit) {
			echo sprintf("<li><a href='index.php?id=%s'>%s</a><br>
				 Yazarı: %s, Yayın Tarihi: %s </li>",
				$kayit["id"],
				$kayit["baslik"],
				$kayit["yazar"],
				date("d.m.Y", strtotime($kayit["tarih"]))
			);
		}
		?>
	</ul>

<?php } // if ( !isset( $_GET["id"])  ) { ?>


<?php

	if (isset($_GET["id"])) {

		require_once "admin/config.php";

		$pdo = new PDO("mysql:host=localhost;dbname=veritabani", "kullaniciadi", "sifre");
		$sql = "SELECT * FROM yazilar WHERE id = :id";
		$statement = $pdo->prepare($sql);
		$statement->bindParam(":id", $_GET["id"]);
		$statement->execute();
		$kayit = $statement->fetch(PDO::FETCH_ASSOC);

		echo "<a href='index.php'>Geri dön...</a>";
		echo "<h1>" . $kayit["baslik"] . "</h1>";

		echo nl2br($kayit["yazi"]);
	}

?>

</body>
</html>