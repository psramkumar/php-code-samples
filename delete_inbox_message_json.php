<?php

$data = array(
    'User' => 'winnie',
    'Password' => 'the-pooh',
);

$curl = curl_init('https://app.eztexting.com/incoming-messages/123?format=json&_method=DELETE');
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($curl);
curl_close($curl);

if (!empty($response)) {
    $json = json_decode($response);
    $json = $json->Response;

    if ('Failure' == $json->Status) {
        $errors = array();
        if (!empty($json->Errors)) {
            $errors = $json->Errors;
        }

        echo 'Status: ' . $json->Status . "\n" .
            'Errors: ' . implode(', ', $errors) . "\n";
    }
}
else {
    echo 'Status: Success' . "\n";
}

?>