<?php
function validate_email($email){
    $api_key = "d3bbbaec88c44c6eb50fd1ab258434e0";

    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => "https://emailvalidation.abstractapi.com/v1?api_key=$api_key&email=$email",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true
    ]);

    $response = curl_exec($ch);

    curl_close($ch);

    $data = json_decode($response, true);

    if ( ( $data['deliverability'] === "UNDELIVERABLE") || ($data["is_disposable_email"]["value"] === true) ) {
        return false;

    }else return true;

}


?>