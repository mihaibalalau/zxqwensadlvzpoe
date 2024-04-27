<?php

namespace Mihaib\PortalJustService\Services;

use stdClass;
use Mihaib\PortalJustService\Queries\GetDosareQuery;
use Mihaib\PortalJustService\Collections\DosareCollection;
use SimpleXMLElement;

class DosarService
{
    public function __construct(
        private PortalApiClient $portalClient
    ) {
    }

    public function get(GetDosareQuery $query): DosareCollection
    {
        $response = $this->portalClient->getDosare($query);

        if ($response instanceof SimpleXMLElement) {
            return $this->parseXml($response);
        }

        return $this->parseSoap($response);
    }

    private function parseXml(SimpleXMLElement $xml): DosareCollection
    {
        $dosare = [];

        foreach ($xml->Dosar as $dosar) {
            $dosare[] = DosarFactory::fromXML($dosar);
        }

        return new DosareCollection($dosare);
    }

    private function parseSoap(stdClass $data): DosareCollection
    {
        if (!isset($data->CautareDosare2Result)) {
            return new DosareCollection();
        }

        $data = $data->CautareDosare2Result->Dosar;

        if (!is_array($data)) {
            $data = [$data];
        }

        $dosare = array_map([DosarFactory::class, 'fromSoap'], $data);

        return new DosareCollection($dosare);
    }
}
