<?php

//returns array with 100 URLs to images from Pixabay.com, based on a "keyword"
function getImageURLs($keyword, $orientation="horizontal") {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://pixabay.com/api/?key=10256982-8575c47e4b70142888903be52&q=$keyword&image_type=photo&orientation=$orientation&safesearch=true&per_page=100",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
      ),
    ));
    
    $jsonData = curl_exec($curl);
    $data = json_decode($jsonData, true); //true makes it an array!
    
    $imageURLs = array();
    for ($i = 0; $i < 99; $i++) {
    $imageURLs[] = $data['hits'][$i]['webformatURL'];
    }
    $err = curl_error($curl);
    curl_close($curl);
    
    return $imageURLs;
}

?>
