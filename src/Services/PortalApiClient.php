<?php

namespace Mihaib\PortalJustService\Services;

use Mihaib\PortalJustService\Queries\GetDosareQuery;
use Mihaib\PortalJustService\Queries\GetSedinteQuery;

class PortalApiClient
{
    private ApiClient $client;

    public function __construct(
        string $wsdlPath
    ) {
        $this->client = new ApiClient($wsdlPath);
    }

    public function getDosare(GetDosareQuery $query): mixed
    {
        return $this->client->request('CautareDosare2', array_filter([
            'numarDosar' => $query->numarDosar,
            'obiectDosar' => $query->obiectDosar,
            'numeParte' => $query->numeParte,
            'institutie' => $query->institutie,
            'dataStart' => $query->dataStart,
            'dataStop' => $query->dataStop,
            'dataUltimaModificareStart' => $query->dataUltimaModificareStart,
            'dataUltimaModificareStop' => $query->dataUltimaModificareStop,
        ], fn ($v) => !is_null($v)));
    }

    public function getSedinte(GetSedinteQuery $query): mixed
    {
        return $this->client->request('CautareSedinte', [
            'dataSedinta' => $query->dataSedinta,
            'institutie' => $query->institutie,
        ]);
    }
}
