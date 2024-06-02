<?php

namespace Mihaib\PortalJustService\Services;

use SimpleXMLElement;
use SoapClient;
use SoapFault;
use stdClass;

class ApiClient
{
    private SoapClient $client;

    public function __construct(string $wsdlPath)
    {
        $this->client = new \SoapClient($wsdlPath, [
            'soap_version' => SOAP_1_2,
            'keep_alive' => false,
            'trace' => true,
            'exceptions' => true
        ]);
    }

    public function request(string $path, array $params): stdClass|SimpleXMLElement
    {
        try {
            $response = $this->client->$path($params);

            return $response;
        } catch (SoapFault $fault) {

            $response = $this->client->__getLastResponse();

            if (!$response) {
                throw $fault;
            }

            $response = $this->manualParseXml($response);

            return $response;
        }
    }

    private function manualParseXml(string $source): SimpleXMLElement
    {
        $source = str_replace('xmlns="portalquery.just.ro"', 'xmlns="http://portalquery.just.ro"', $source);
        $source = preg_replace('/&#x(?:0[0-9A-Fa-f]|1[0-9A-Fa-f]);/', '', $source);

        $xml =  simplexml_load_string($source);

        $namespaces = $xml->getNamespaces(true);

        return $xml->children($namespaces['soap'])
            ->Body
            ->children()
            ->CautareDosare2Response
            ->children('http://portalquery.just.ro')
            ->CautareDosare2Result;
    }
}
