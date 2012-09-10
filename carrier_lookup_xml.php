<?php

$data = array(
    'User'     => 'winnie',
    'Password' => 'the-pooh'
);

$curl = curl_init('https://app.eztexting.com/sending/phone-numbers/2345678910?format=xml&' . http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// If you experience SSL issues, perhaps due to an outdated SSL cert
// on your own server, try uncommenting the line below
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($curl);
curl_close($curl);

$xml = new SimpleXMLElement($response);
if ( 'Failure' == $xml->Status ) {
    $errors = array();
    foreach( $xml->Errors->children() as $error ) {
        $errors[] = (string) $error;
    }

    echo 'Status: ' . $xml->Status . "\n" .
         'Errors: ' . implode(', ' , $errors) . "\n";
} else {
    echo 'Status: ' . $xml->Status . "\n" .
         'Phone number: ' . $xml->Entry->PhoneNumber . "\n" .
         'CarrierName: ' . $xml->Entry->CarrierName . "\n";
}

?>