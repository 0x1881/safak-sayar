<?php

date_default_timezone_set("Europe/Istanbul");

function trupper($text)
{
    $search=array("ç","i","ı","ğ","ö","ş","ü");
    $replace=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
    $text=str_replace($search,$replace,$text);
    $text=strtoupper($text);
    return $text;
}

$sehirler=["Adana","Adıyaman","Afyon","Ağrı","Amasya","Ankara","Antalya","Artvin","Aydın","Balıkesir","Bilecik","Bingöl","Bitlis","Bolu","Burdur","Bursa","Çanakkale","Çankırı","Çorum","Denizli","Diyarbakır","Edirne","Elazığ","Erzincan","Erzurum","Eskişehir","Gaziantep","Giresun","Gümüşhane","Hakkari","Hatay","Isparta","İçel (Mersin)","İstanbul","İzmir","Kars","Kastamonu","Kayseri","Kırklareli","Kırşehir","Kocaeli","Konya","Kütahya","Malatya","Manisa","Kahramanmaraş","Mardin","Muğla","Muş","Nevşehir","Niğde","Ordu","Rize","Sakarya","Samsun","Siirt","Sinop","Sivas","Tekirdağ","Tokat","Trabzon","Tunceli","Şanlıurfa","Uşak","Van","Yozgat","Zonguldak","Aksaray","Bayburt","Karaman","Kırıkkale","Batman","Şırnak","Bartın","Ardahan","Iğdır","Yalova","Karabük","Kilis","Osmaniye","Düzce"];
$yol_izin = 2;
$kullanilmayan_izin = 6;
$ceza = 0;
$tutanak = 0;
$plaka = 33;

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

$gecen_gun = $tarih1->diff($tarih2);
$gecen_gun_format = intval($gecen_gun->format('%a'));

$kalan_gun = $tarih2->diff($tarih3);
$kalan_gun_format = intval($kalan_gun->format('%a'));

$memlekete_kalan_gun = $tarih2->diff($tarih4);
$memlekete_kalan_gun_format = intval($memlekete_kalan_gun->format('%a'));

$safak = ($kalan_gun_format-$toplam_izin);
$atarsa = (($kalan_gun_format-$toplam_izin)-1);
$safak_sehir = trupper($sehirler[($safak-1)]);
$atarsa_sehir = trupper($sehirler[($atarsa-1)]);

echo "SEVK TARİHİ: ".$sevk_tarihi."<br>";
echo "RESMİ KATILIŞ TARİHİ: ".$resmi_katilis_tarihi."<br>";
echo "GERÇEK KATILIŞ TARİHİ: ".$gercek_katilis_tarihi."<br>";
echo "RESMİ TERHİS TARİHİ: ".$resmi_terhis."<br>";
echo "TMİ TERHİS TARİHİ: ".$tmi_terhis."<br>";
echo "CEZA: ".$ceza."<br>";
echo "TUTANAK: ".$tutanak."<br>";
echo "GEÇEN GÜN: ".$gecen_gun_format. "<br>";
echo "ŞAFAK: ".$safak." / ".$safak_sehir."<br>";
echo "ATARSA: ".$atarsa." / ".$atarsa_sehir."<br>";
echo "PLAKA: ".$plaka."<br>";
echo "MEMLEKETE KALDI: ".($memlekete_kalan_gun_format - $ceza)." GÜN / ".$memleket_tarihi;
