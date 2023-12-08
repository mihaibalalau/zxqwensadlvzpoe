<?php

namespace Mihaib\PortalJustService;

use Exception;
use Mihaib\PortalJustService\Dosar\DosarPortalFactory;
use Mihaib\PortalJustService\Dosar\Entities\DosarePortalCollection;
use Mihaib\PortalJustService\Dosar\GetDosarePortalQuery;
use Mihaib\PortalJustService\Services\ApiClient;
use stdClass;

class PortalJust
{
    private ApiClient $client;

    public function __construct(
        string $wsdlPath
    ) {
        $this->client = new ApiClient($wsdlPath);
    }

    public function getDosare(GetDosarePortalQuery $query): DosarePortalCollection
    {
        if (!$query->isValid()) {
            throw new Exception("Invalid query!");
        }

        $response = $this->client->request('CautareDosare2', array_filter($query->toArray(), fn ($v) => !is_null($v)));

        if (!isset($response->CautareDosare2Result)) {
            return new DosarePortalCollection();
        }

        if (!is_array($response->CautareDosare2Result->Dosar)) {
            $result = [$response->CautareDosare2Result->Dosar];
        } else {
            $result = $response->CautareDosare2Result->Dosar;
        }

        return new DosarePortalCollection(array_map(fn (stdClass $data) => DosarPortalFactory::fromObject($data), $result));
    }

    // public function getSedinte(array $filters)
    // {
    //     $response = $this->client->request('CautareSedinte', $filters);

    //     if (!isset($response->CautareSedinteResult)) {
    //         return [];
    //     }

    //     if (!is_array($response->CautareSedinteResult->Sedinta)) {
    //         $result = [$response->CautareSedinteResult->Sedinta];
    //     } else {
    //         $result = $response->CautareSedinteResult->Sedinta;
    //     }

    //     return $result;
    // }
}
