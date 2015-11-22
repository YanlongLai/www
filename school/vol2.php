<?php
//$vol=$_GET['vol'];
//$comicPage = file_get_contents('http://manhua.fzdm.com/'.$vol.'/');
$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL,'http://www.ukuni.net/zh-hans/uk-ranking/subject/%E4%B8%9C%E4%BA%9A%E5%92%8C%E5%8D%97%E4%BA%9A%E7%A0%94%E7%A9%B6');
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Comic');
$Page = curl_exec($curl_handle);
curl_close($curl_handle);
//echo $vol;
//echo $Page;
//$url=preg_match_all('/<a href="(.+)">/', $comicPage, $match);

// $list=preg_match_all('#<a href=[\'"][^>]*[\'"] title=[^>]*>#i', $comicPage, $match2);
$list=preg_match_all('#<option[^>]*>(?P<name>[^<]*)</option>#i', $Page, $match);
// print (count($match[0]));
// var_dump($match);
for ($i=1; $i < count($match["name"]); $i++) { 
// for ($i=1; $i < 2; $i++) { 
	//echo $match["name"][$i];
	$curl_handle=curl_init();
	curl_setopt($curl_handle, CURLOPT_URL,'http://www.ukuni.net/zh-hans/uk-ranking/subject/'.urlencode($match["name"][$i]));
	curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Comic');
	$Page = curl_exec($curl_handle);
	curl_close($curl_handle);
	// echo $Page;
	$list=preg_match_all('#<span class="uni-name-titletext">[^<]*<a href=[^>]*>(?P<name>.*)</a>[^<]*</span>#i', $Page, $match2);
	// var_dump($match2["name"]);
	// $list=preg_match_all('#<span class="timesred">(?P<name>.*)</span>#i', $Page, $match2);
	// $list=preg_match_all('#<span class=.*>(?P<name>.*)</span>#i', $Page, $match2);
	$list=preg_match_all('#"timesred">(?P<name>.*)[^<]*</span>#i', $Page, $match3);
	// var_dump($match3["name"]);
	$matchLen = count($match2["name"]);
	for ($j=0; $j < $matchLen; $j++) { 
		if($j == 0)
		echo ("'\"".$match["name"][$i]."\" : [' +");	
		if($j < $matchLen -1)
		echo ("'{ \"Name\":\"".$match2["name"][$j]."\" , \"order\":\"".$match3["name"][$j]. "\" },' +\n");
		if($j == $matchLen -1)
		echo ("'{ \"Name\":\"".$match2["name"][$j]."\" , \"order\":\"".$match3["name"][$j]. "\" } ],' +\n");
	}

}

// $list=preg_match_all('#<span class="timesred">(?P<name>.*)</span>#i', $Page, $match2);
//var_dump($match2["name"]);
 // '"human" : [' +
// '{ "Name":"劍橋大學" , "order":"1" },' +
// '{ "Name":"牛津大學" , "order":"2" },' +
// '{ "Name":"倫敦帝國理工學院" , "order":"3" } ],' +

// for ($i=0; $i < count($match["name"]); $i++) { 
//   echo ("'{ \"Name\":\"".$match["name"][$i]."\" , \"order\":\"".$match2["name"][$i]. "\" },' +\n");
// }
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
