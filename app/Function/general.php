<?php 

    function curlGetCart($url){
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => $url,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     // CURLOPT_TIMEOUT => 30000,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     curl_setopt($curl, CURLOPT_HTTPHEADER, array("Cookie: laravel_session={$_COOKIE['laravel_session']}")),
        //     CURLOPT_CUSTOMREQUEST => "GET",
        //     // CURLOPT_HTTPHEADER => array(
        //     //     // Set Here Your Requesred Headers
        //     //     'Content-Type: application/json',
        //     // ),
        // ));
       
        // $response = curl_exec($curl);

        // $err = curl_error($curl);

        // curl_close($curl);

        // if ($err) {
            
        //     return array('status' => 2);

        // } else {

        //     return json_decode($response);

        // }

        $token = '435354353453434';

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_PORT           => "80",
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => "",
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => "GET",
        CURLOPT_HTTPHEADER     => array(
            "Authorization: Bearer ".$token."",
            ),
        ));
        
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
        return json_decode($response,true);
        
    }

?>