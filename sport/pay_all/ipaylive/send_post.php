<?php

	header("Content-type: text/html; charset=utf-8");
	
	
	$postArray = $_POST;
	$url = 'http://202.146.216.16:9487/api/request';
	
	//$result = send_post($url, $postArray);
	send_post($url, $postArray);
	
	
	
	
	function send_post ($gateway, $requestdata) {
		
        $postdata = http_build_query($requestdata);
        $options = array( 'http' => array( 
            'method' => 'POST',
            'header' =>'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' =>  10, // 超时时间（单位:s） 
            'ignore_errors' => true   
            )  
        );
        $context = stream_context_create($options);
        $output = file_get_contents($gateway, false, $context);
        //$data = json_decode($output ,true);
        return $output;
    }


?>