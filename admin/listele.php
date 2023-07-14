<?php
	require_once "kontrol.php";
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

	$query = "SELECT * FROM yazilar ORDER BY id DESC";
	$stmt = $pdo->query($query);
	$kayitlar = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP Örneğimiz</title>
	<style>
		ul {
			list-style-type: none;
			padding: 0;
		}

		li {
			margin-bottom: 20px;
		}

		a {
			text-decoration: none;
			color: #000;
		}

		.blog-title {
			font-size: 18px;
			font-weight: bold;
		}

		.author {
			font-style: italic;
		}

		.publish-date {
			color: #888;
		}
	</style>
</head>
<body>

	<a href="menu.php">Ana Sayfa</a>

	<h1>Blog Sitemizdeki Yazılar...</h1>

	<ul>
		<?php foreach ($kayitlar as $kayit) : ?>
			<li>
				<div class="blog-title">
					<a href='yazioku.php?id=<?= htmlspecialchars($kayit["id"]); ?>'>
						<?= htmlspecialchars($kayit["baslik"]); ?>
					</a>
				</div>
				<div class="author">
					Yazarı: <?= htmlspecialchars($kayit["yazar"]); ?>
				</div>
				<div class="publish-date">
					Yayın Tarihi: <?= date("d.m.Y", strtotime(htmlspecialchars($kayit["tarih"]))); ?>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>

</body>
</html>