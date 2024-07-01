<?php

function api_request($route, $method = 'GET', $variables = [])
{
    // initiate the curl client
    $client = curl_init();
    // return the result as a string
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    // defines the URL
    $url = API_BASE_URL;

    // if request is GET
    if($method == 'GET'){
        $url .= "?endpoint=$route";
        if(!empty($variables)){
            $url .= "&" . http_build_query($variables);
        }
    }

    // if request is POST
    if($method == 'POST')
    {
        $variables = array_merge(['endpoint' => $route], $variables);
        curl_setopt($client, CURLOPT_POSTFIELDS, $variables);
    }

    curl_setopt($client, CURLOPT_URL, $url);

    $response = curl_exec($client);
    return json_decode($response, true);
}
