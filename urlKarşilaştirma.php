<?php
$Link= $_POST['aramaLink'];
$Kelime = strtolower($_POST['aramaKelime']);
function curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $icerik = curl_exec($ch);
    curl_close($ch);
    return $icerik;
}
$arananLink = explode(" ",$Link);
$sayiLink = count($arananLink);
$arananKelime = explode(" ",$Kelime);
$sayiKelime = count($arananKelime);
$Kelimeler[$sayiLink][$sayiKelime];
for($i = 0;$i<$sayiLink;$i++)
{
  $url = $arananLink[$i];
  $veri = curl($url);
  $veri = strip_tags(strtolower($veri));
  echo "$arananLink[$i]";
  echo ('<br>');
  for($j = 0;$j<$sayiKelime;$j++)
  {
  $KSayi = substr_count($veri,$arananKelime[$j]);
  $Kelimeler[$i][$j] = $Ksayi;
  echo "$arananKelime[$j] : $KSayi";
  echo ('<br>');
  }
}

 ?>
