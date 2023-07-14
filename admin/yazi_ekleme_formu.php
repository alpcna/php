<?php
require_once "kontrol.php";

if (isset($_POST["yazar"])) {
    // Form submit edilmiş demektir...
    // echo "<pre>"; print_r($_POST); echo "</pre>";
    require_once "ayar.php";

    $dsn = "mysql:host=localhost;dbname=veritabaniadi;charset=utf8";
    $username = "kullaniciadi";
    $password = "sifre";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO yazilar (yazar, tarih, baslik, yazi) 
 VALUES(:yazar, :tarih, :baslik, :yazi)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':yazar', $_POST["yazar"]);
        $stmt->bindParam(':tarih', $_POST["tarih"]);
        $stmt->bindParam(':baslik', $_POST["baslik"]);
        $stmt->bindParam(':yazi', $_POST["yazi"]);

        $stmt->execute();

        header("Location: islemtamam.php");
        exit();
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
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

<a href="menu.php">Ana Sayfa</a>

<h1>Yazı Ekleyelim...</h1>

<form action="" method="post">

    <p>Yazarı: <b style="color:darkred;"><?php echo $_SESSION["adisoyadi"]; ?></b>
        <input type="hidden" name="yazar" value="<?php echo $_SESSION["adisoyadi"]; ?>"></p>
    <p>Yayın Tarihi: <input type="text" name="tarih" value="" placeholder="yıl-ay-gun formatında"></p>
    <p>Yazı Başlığı: <input type="text" name="baslik" value="" placeholder=""></p>
    <p>Yazı İçeriği: <textarea name="yazi" style="width: 500px; height:150px;"></textarea></p>

    <button type="submit">Gönder</button>
</form>

</body>
</html>