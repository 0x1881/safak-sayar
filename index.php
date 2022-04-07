<?php

date_default_timezone_set("Europe/Istanbul");

$sehirler=["ADANA","ADIYAMAN","AFYON","AĞRI","AMASYA","ANKARA","ANTALYA","ARTVİN","AYDIN","BALIKESİR","BİLECİK","BİNGÖL","BİTLİS","BOLU","BURDUR","BURSA","ÇANAKKALE","ÇANKIRI","ÇORUM","DENİZLİ","DİYARBAKIR","EDİRNE","ELAZIĞ","ERZİNCAN","ERZURUM","ESKİŞEHİR","GAZİANTEP","GİRESUN","GÜMÜŞHANE","HAKKARİ","HATAY","ISPARTA","İÇEL (MERSİN)","İSTANBUL","İZMİR","KARS","KASTAMONU","KAYSERİ","KIRKLARELİ","KIRŞEHİR","KOCAELİ","KONYA","KÜTAHYA","MALATYA","MANİSA","KAHRAMANMARAŞ","MARDİN","MUĞLA","MUŞ","NEVŞEHİR","NİĞDE","ORDU","RİZE","SAKARYA","SAMSUN","SİİRT","SİNOP","SİVAS","TEKİRDAĞ","TOKAT","TRABZON","TUNCELİ","ŞANLIURFA","UŞAK","VAN","YOZGAT","ZONGULDAK","AKSARAY","BAYBURT","KARAMAN","KIRIKKALE","BATMAN","ŞIRNAK","BARTIN","ARDAHAN","IĞDIR","YALOVA","KARABÜK","KİLİS","OSMANİYE","DÜZCE"];
$ceza = 0;
$tutanak = 0;
$plaka = 33;
$yol_izin = 2;
$kullanilmayan_izin = 6;
$toplam_izin = ($yol_izin + $kullanilmayan_izin) - $ceza;

$sevk_tarihi = "2021-10-26";
$resmi_katilis_tarihi = "2021-10-29";
$gercek_katilis_tarihi = "2021-10-28";
$bugun = date('Y-m-d');
$resmi_terhis = date('Y-m-d', strtotime($sevk_tarihi. ' + 6 months'));
$tmi_terhis = date('Y-m-d', strtotime($resmi_terhis. ' - '.$toplam_izin.' days'));
$memleket_tarihi = date('Y-m-d', strtotime($tmi_terhis. ' - '.$plaka.' days'));

$tarih1 = new DateTime($sevk_tarihi);
$tarih2 = new DateTime($bugun);
$tarih3 = new DateTime($resmi_terhis);
$tarih4 = new DateTime($memleket_tarihi);
$tarih5 = new DateTime($tmi_terhis);

$gecen_gun = $tarih1->diff($tarih2);
$gecen_gun_format = intval($gecen_gun->format('%a'));

$kalan_gun = $tarih2->diff($tarih3);
$kalan_gun_format = intval($kalan_gun->format('%a'));

$memlekete_kalan_gun = $tarih2->diff($tarih4);
$memlekete_kalan_gun_format = (intval($memlekete_kalan_gun->format('%a')) - $ceza);

$toplam_gun_tmisiz = $tarih1->diff($tarih3);
$toplam_gun_tmisiz_format = intval($toplam_gun_tmisiz->format('%a'));

$toplam_gun_tmi = $tarih1->diff($tarih5);
$toplam_gun_tmili_format = intval($toplam_gun_tmi->format('%a'));

$safak = ($kalan_gun_format-$toplam_izin);
$atarsa = (($kalan_gun_format-$toplam_izin)-1);
$safak_sehir = $sehirler[($safak-1)];
$atarsa_sehir = $sehirler[($atarsa-1)];
if ($atarsa === 0) {
	echo "ŞAFAK BİTTİ!";
	exit;
}
echo "SEVK TARİHİ: ".$sevk_tarihi."<br>";
//echo "RESMİ KATILIŞ TARİHİ: ".$resmi_katilis_tarihi."<br>";
//echo "GERÇEK KATILIŞ TARİHİ: ".$gercek_katilis_tarihi."<br>";
echo "RESMİ TERHİS TARİHİ: ".$resmi_terhis."<br>";
echo "TMİ TERHİS TARİHİ: ".$tmi_terhis."<br>";
echo "CEZA: ".$ceza."<br>";
echo "TUTANAK: ".$tutanak."<br>";
echo "TOPLAM TMİ ÇIKARILMAMIŞ GÜN: ".$toplam_gun_tmisiz_format. "<br>";
echo "TOPLAM TMİ ÇIKARILMIŞ GÜN: ".$toplam_gun_tmili_format. "<br>";
echo "GEÇEN GÜN: ".$gecen_gun_format. "<br>";
echo "ŞAFAK: ".$safak." / ".$safak_sehir."<br>";
echo "ATARSA: ".$atarsa." / ".$atarsa_sehir."<br>";
echo "PLAKA: ".$plaka."<br>";
if(strtotime($bugun) < strtotime($memleket_tarihi)) {
	echo "MEMLEKETE KALDI: ".($memlekete_kalan_gun_format)." GÜN / ".$memleket_tarihi;
}
echo "<br>SAAT FARKI İLE GERİ SAYIM: $tmi_terhis 08:00:00<br>";
include 'safakjs.php';
