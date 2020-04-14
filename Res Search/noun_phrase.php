<?php


function RequestCURL($url, $header = array(), $postArr = '')
{

    $post = http_build_query($postArr, '&');

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);

    if (!empty($post)) {
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    }

    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

function query($text)
{
    // Content-Type: application/json
    $response = RequestCURL('https://textanalysis.p.rapidapi.com/spacy-noun-chunks-extraction', array(
        "X-Mashape-Key: 3de93acbaamsh1694cb8b9f768fap18c1bajsn02ca3ba6ddc1",
        "Content-Type: application/x-www-form-urlencoded",
        "Accept: application/json"
    ), array(
        "text" => $text
    ));
    return $response;
}

//get request
$text = $_GET['text'];
echo query($text);

?>