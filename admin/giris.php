<?php

	session_start();
	if (isset($_SESSION["girisyapti"]) && $_SESSION["girisyapti"] == 1) {
		// Zaten login olmuş. Menüye yönlendirelim...
		header("Location: menu.php");
		die();
	}

	if (isset($_POST["user"])) { // Login olmaya çalışıyoruz
		$user = $_POST["user"];
		$pass = $_POST["pass"];

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

		$query = "SELECT * FROM kullanicilar 
			WHERE kullaniciadi = :user AND kullaniciparolasi = :pass";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(":user", $user);
		$stmt->bindParam(":pass", $pass);
		$stmt->execute();

		$kayit = $stmt->fetch(PDO::FETCH_ASSOC);
		$KayitAdedi = $stmt->rowCount();

		if ($KayitAdedi == 1) { // login başarılı :)
			session_start();
			$_SESSION["adisoyadi"]  = $kayit["adisoyadi"];
			$_SESSION["id"]         = $kayit["id"];
			$_SESSION["girisyapti"] = 1;
			header("Location: menu.php");
		} else {
			session_start();
			$_SESSION["girisyapti"]   = 0;
			echo "parola yanlış";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP Örneğimiz</title>
</head>
<body>

	<h1>Yönetim Paneli Girişi</h1>
	
	<form action="" method="post">
		<p>Kullanıcı Adınız: <input type="text" name="user" value="" autocomplete="off"></p>
		<p>Kullanıcı Parolanız: <input type="password" name="pass" value=""></p>
		<p><button type="submit">Giriş yap</button></p>
	</form>

</body>
</html>