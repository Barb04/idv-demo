<?php
    $access_token = oAuth();
    $retrival_status=array();
    $retrival_details=array();
    $max_retries = 10;
    $retry_count = 0;
    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://retrieval.".$_SESSION['SITE']['datacenter']."/api/v1/accounts/".$_SESSION['TRANSACTION']["RETURN"]['accountId']."/workflow-executions/".$_SESSION['TRANSACTION']["RETURN"]['workflowExecutionId']."/status",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => [
        "Authorization: Bearer ". $access_token ,
        "Content-Type: application/json",
        "User-Agent: Jumio SE Testing"
      ],
    ]);
    while ($retry_count <= $max_retries) {
      $response = curl_exec($curl);
      $retrival_status=json_decode($response,TRUE);
      if($retrival_status["workflowExecution"]["status"] === "PROCESSED"){break;}
      time_sleep_until(time() + 5);
      $retry_count++;
    }
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://retrieval.".$_SESSION['SITE']['datacenter']."/api/v1/accounts/".$_SESSION['TRANSACTION']["RETURN"]['accountId']."/workflow-executions/".$_SESSION['TRANSACTION']["RETURN"]['workflowExecutionId'],
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => [
        "Authorization: Bearer ". $access_token ,
        "Content-Type: application/json",
        "User-Agent: Jumio SE Testing"
      ],
    ]);
    $response = curl_exec($curl);
    $_SESSION['TRANSACTION']["RETRIVAL_1"]=json_decode($response,TRUE);
//====================================================
#echo '<hr>'.json_encode($_SESSION, JSON_PRETTY_PRINT).'<hr>';exit;
