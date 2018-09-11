<?php
$Link = $_POST['aramaLink'];
$Kelime = $_POST['aramaKelime'];
$ch = curl_init();
$url = $Link;
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
$veri = curl_exec($ch);
curl_close($ch);
$veri = strip_tags(strtolower($veri));
$aranan = explode(" ",$Kelime);
$sayiKelime = count($aranan);
echo "$Link";
echo ('<br>');
for($i=0;$i<$sayiKelime;$i++)
{
  $KSayi = substr_count($veri,$aranan[$i]);
  echo "$aranan[$i] : $KSayi";
  echo ('<br>');
}
?>
