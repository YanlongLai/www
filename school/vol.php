<?php
//$vol=$_GET['vol'];
//$comicPage = file_get_contents('http://manhua.fzdm.com/'.$vol.'/');
$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL,'http://www.ukuni.net/zh-hans/uk-ranking/overall');
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Comic');
$Page = curl_exec($curl_handle);
curl_close($curl_handle);
//echo $vol;
//echo $Page;
//$url=preg_match_all('/<a href="(.+)">/', $comicPage, $match);

// $list=preg_match_all('#<a href=[\'"][^>]*[\'"] title=[^>]*>#i', $comicPage, $match2);
$list=preg_match_all('#<span class="uni-name-titletext"[^>]*>.*>(?P<name>.*)</a></span>#i', $Page, $match);
//print (count($match[0]));
//var_dump($match["name"]);

$list=preg_match_all('#<span class="timesred">(?P<name>.*)</span>#i', $Page, $match2);
//var_dump($match2["name"]);

// '{ "Name":"劍橋大學" , "order":"1" },' +
// '{ "Name":"牛津大學" , "order":"2" },' +
// '{ "Name":"倫敦帝國理工學院" , "order":"3" } ],' +

for ($i=0; $i < count($match["name"]); $i++) { 
  echo ("'{ \"Name\":\"".$match["name"][$i]."\" , \"order\":\"".$match2["name"][$i]. "\" },' +\n");
}
/*
$comicVol=count($match2[0]);
//print_r($match2);
//print $comicVol;
for($i=0;$i<$comicVol;$i++){
    //$href=preg_match_all('#<a href=[\'"]index_[^>]*>#i', $comicPic, $match2);
    if(stristr($match2[0][$i], $title)===FALSE){ 
        //print($title);
    }
    else
    print("<div>".$match2[0][$i]."</div>");
    //if(($i+1)%5==0)
    //print("<br>");
}
*/
?>
