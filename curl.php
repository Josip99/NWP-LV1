<?php
    include("simple_html_dom.php");
    

    $url = "https://stup.ferit.hr/index.php/zavrsni-radovi/page/3"; 
    $curl_init = curl_init();
    curl_setopt($curl_init, CURLOPT_URL, $url);
    curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($curl_init);
    curl_close($curl_init);

    $dom = new simple_html_dom();
    $dom->load($html);
    $text = $dom->find('.fusion-post-content-container p', 0);
    $title = $dom->find('.blog-shortcode-post-title a', 0);
    $link = $title->getAttribute("href");
    $image = $dom->find('.fusion-image-wrapper img', 0);
    $src = $image->getAttribute("src");
    $oib = basename($src, ".png");
    
    /* //Raw html
    echo $title;
    //Just plaintext
    echo $title->plaintext;
    echo $text->plaintext;
    echo $src;
    echo $oib;
    echo $link; */

    $data=array();
    $data['title'] = $title->plaintext;
    $data['link'] = $link;
    $data['oib'] = $oib;
    $data['text'] = $text->plaintext;
    //print_r($data);

    $titles = $dom->find('.fusion-post-content-container p');
    $articleNumber = count($titles);

    //print_r($articleNumber);


    $allData=array();
    function getAll(){
        $dom = new simple_html_dom();
        //$redni_broj=rand(2,6);
        //For example let's use just [2] as a random number
        $redni_broj=2;
        $url = "https://stup.ferit.hr/index.php/zavrsni-radovi/page/$redni_broj"; 
        $curl_init = curl_init();
        curl_setopt($curl_init, CURLOPT_URL, $url);
        curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($curl_init);
        curl_close($curl_init);
        $dom->load($html);
        
        $titles = $dom->find('.fusion-post-content-container p');
        $articleNumber = count($titles);

        for($i=0; $i<$articleNumber; $i++){
            $allData[$i] = array();
            $text = $dom->find('.fusion-post-content-container p', $i);
            $title = $dom->find('.blog-shortcode-post-title a', $i);
            $link = $title->getAttribute("href");
            $image = $dom->find('.fusion-image-wrapper img', $i);
            $src = $image->getAttribute("src");
            $oib = basename($src, ".png");

            $allData[$i]['title'] = $title->plaintext;
            $allData[$i]['link'] = $link;
            $allData[$i]['oib'] = $oib;
            $allData[$i]['text'] = $text->plaintext;
        }
        return $allData;
    }
    


              
?>