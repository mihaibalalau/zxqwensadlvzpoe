<?php

namespace Mihaib\PortalJustService\Services;

use SoapClient;
use stdClass;

class ApiClient
{
    private SoapClient $client;

    public function __construct(string $wsdlPath)
    {
        $this->client = new \SoapClient($wsdlPath);
    }

    public function request(string $path, array $params): stdClass
    {
        $response = $this->client->$path($params);

        return $response;
    }
}
