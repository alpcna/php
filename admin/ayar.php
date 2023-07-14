<?php

// veritabanı bilgileri
$sunucu = 'localhost';
$veritabaniAdi = 'veritabanı_adı';
$veritabaniKullanici = 'veritabanı_kullanıcı_adı';
$veritabaniSifre = 'veritabanı_şifresi';

// veritabanına bağlanma işlemi...
try {
    $baglanti = new PDO("mysql:host=$sunucu;dbname=$veritabaniAdi;charset=utf8", $veritabaniKullanici, $veritabaniSifre);
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Veritabanına başarıyla bağlandı!";
} catch (PDOException $e) {
    die("Veritabanına bağlantı hatası: " . $e->getMessage());
}