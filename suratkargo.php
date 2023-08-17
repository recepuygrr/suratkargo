<?php
// Kargo kontrolü
$no = "0000000000000000"; //sürat kargo'dan size verilen takip numarası
	if($no != ""){
		$data = array("kargotakipno" => $no);
		$options = array('http' => array('method' => 'POST','content' => http_build_query($data),'header' => "Content-Type: application/x-www-form-urlencoded\r\n"));
		$context = stream_context_create($options);
        $result = file_get_contents('https://suratkargo.com.tr/KargoTakip/', false, $context);
        preg_match_all('/<img\s+src=["\'](.*?)["\'].*?>/', $result, $matches);
        $imageUrl = isset($matches[1][1]) ? $matches[1][1] : "";
		if (!empty($imageUrl)) {
			$img = "<center><a target='_blank' href='https://suratkargo.com.tr/KargoTakip/?kargotakipno=".$no."'><img style='max-width: 100%;' width='880px' src='https://suratkargo.com.tr/$imageUrl'></a></center>";
		}else{
			$img = "";
		}
	}
echo $img;
?>
