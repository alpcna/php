<?php
	require_once "kontrol.php";

	if (isset($_POST["pass1"])) {
		if ($_POST["pass2"] != $_POST["pass3"]) {
			echo "Yeni Parola yanı değil...";
			die();
		}
	}

	if (isset($_POST["pass1"])) {
		// Form submit edilmiş demektir...
		// echo "<pre>"; print_r($_POST); echo "</pre>";
		require_once "ayar.php";

		$dsn = "mysql:host=localhost;dbname=veritabani;charset=utf8mb4";
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_EMULATE_PREPARES => false,
		];

		try {
			$pdo = new PDO($dsn, $db_kullanici, $db_sifre, $options);
		} catch (PDOException $e) {
			die("Veritabanı bağlantısı başarısız: " . $e->getMessage());
		}

		$query = "UPDATE kullanicilar SET kullaniciparolasi = :pass2 WHERE id = :id AND kullaniciparolasi = :pass1";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(":pass2", $_POST["pass2"]);
		$stmt->bindParam(":id", $_SESSION["id"]);
		$stmt->bindParam(":pass1", $_POST["pass1"]);
		$stmt->execute();

		header("Location: islemtamam.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP Örneğimiz</title>
</head>
<body>

	<a href="menu.php">Ana Sayfa</a>


	<h1>Parolanızı Güncelleyin...</h1>

	<form action="" method="post">
		
		<p>Adı Soyadı: <?php echo $_SESSION["adisoyadi"]; ?></p>
		
		<p>Mevcut Parolanız: 
		<input type="password" name="pass1" value=""></p>

		<p>Yeni Parolanız: 
		<input type="password" name="pass2" value=""></p>

		<p>Yeni Parolanız (Tekrar): 
		<input type="password" name="pass3" value=""></p>

		
		<button type="submit">Güncelle</button>
	</form>


</body>
</html>