<?php
require_once 'XML/RPC2/Client.php';

function getAPIInfo() {
    $version_api = XML_RPC2_Client::create(
            'https://rpc.gandi.net/xmlrpc/',
            array( 'prefix' => 'version.', 'sslverify' => False )
        );

    $result = $version_api->__call("info", APIKEY);
    return $result['api_version'];
}

function paasList() {
    $apiConnect = XML_RPC2_Client::create(
            'https://rpc.gandi.net/xmlrpc/',
            array( 'prefix' => 'paas.', 'sslverify' => False )
        );
    $result = $apiConnect->list(APIKEY);
    return $result;
}


function iaasList() {
     $apiConnect = XML_RPC2_Client::create(
            'https://rpc.gandi.net/xmlrpc/',
            array( 'prefix' => 'hosting.', 'sslverify' => False )
        );

    $result = $apiConnect->__call('disk.list', array(APIKEY));
    return $result;
   
}

function iaasImageList() {
     $apiConnect = XML_RPC2_Client::create(
            'https://rpc.gandi.net/xmlrpc/',
            array( 'prefix' => 'hosting.', 'sslverify' => False )
        );

    $result = $apiConnect->__call('image.list', array(APIKEY));
    return $result;
   
}


?>
