<?php
require_once 'XML/RPC2/Client.php';

function getAPIInfo() {
    $version_api = XML_RPC2_Client::create(
            'https://rpc.gandi.net/xmlrpc/',
            array( 'prefix' => 'version.', 'sslverify' => False )
        );

    //$result = $version_api->info($apikey);

    $result = $version_api->__call("info", APIKEY);
    return $result['api_version'];
}

?>
