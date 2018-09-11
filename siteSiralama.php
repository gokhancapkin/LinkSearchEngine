<?php
set_time_limit(0);
$Link = $_POST['aramaLink'];
$Kelime = $_POST['aramaKelime'];
$aranan = explode(" ",$Kelime);
$sayiKelime = count($aranan);
$var = fread_url($Link);

    preg_match_all ("/a[\s]+[^>]*?href[\s]?=[\s\"\']+".
                    "(.*?)[\"\']+.*?>"."([^<]+|.*?)?<\/a>/",$var, $matches);

    $matches = $matches[1];
    $list = array();
    $newList = array();
    if(strstr($Link,"http"))
    {
      $tempLink = strstr($Link,"http");
      $tempLink = explode("://",$Link);
      $tempLink = explode("/",$tempLink[1]);
      $baseLink = "http://".$tempLink[0];
    }
    print($baseLink . '<br>');
    $son = 0;
    foreach($matches as $var)
    {

        if(stristr($var,'http'))
        {
          $list[$son]=$var;
          $son = $son+1 ;
        }
        else
        {
           $list[$son]=$baseLink.$var;
           $son = $son+1 ;
        }
    }
    $new = 0;
    foreach($list as $link)
    {
      if(!in_array($link,$newList))
      {
        if(strstr($link,$baseLink))
        {
          $newList[$new] = $link;
          $new = $new+1;
        }
      }

    }
    foreach($newList as $liste)
    {
      echo $liste."<br>";
      $var = fread_url($liste);

    }

    function fread_url($url,$ref="")
    {
        Global $Ksayi;
        Global $aranan;
        Global $sayiKelime;
        if(function_exists("curl_init")){
            $ch = curl_init();
            $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; ".
                          "Windows NT 5.0)";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
            curl_setopt( $ch, CURLOPT_HTTPGET, 1 );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION , 1 );
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION , 1 );
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_REFERER, $ref );
            curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
            $veri = curl_exec($ch);
            curl_close($ch);
        }
        else{
            $hfile = fopen($url,"r");
            if($hfile){
                while(!feof($hfile)){
                    $veri.=fgets($hfile,1024);
                }
            }
        }
        $veri2 = strip_tags(strtolower($veri));
        for($i=0;$i<$sayiKelime;$i++)
        {
          $KSayi = substr_count($veri2,$aranan[$i]);
          echo "$aranan[$i] : $KSayi";
          echo ('<br>');
        }
        return $veri;
    }
 ?>
