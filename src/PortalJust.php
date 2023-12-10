<?php

namespace Mihaib\PortalJustService;

use Mihaib\PortalJustService\Services\DosarService;
use Mihaib\PortalJustService\Queries\GetDosareQuery;
use Mihaib\PortalJustService\Queries\GetSedinteQuery;
use Mihaib\PortalJustService\Services\SedintaService;
use Mihaib\PortalJustService\Services\PortalApiClient;
use Mihaib\PortalJustService\Collections\DosareCollection;
use Mihaib\PortalJustService\Collections\SedinteCollection;

class PortalJust
{
    private DosarService $dosarService;
    private SedintaService $sedintaService;

    public function __construct(
        string $wsdlPath
    ) {
        $portalClient = new PortalApiClient($wsdlPath);
        $this->dosarService = new DosarService($portalClient);
        $this->sedintaService = new SedintaService($portalClient);
    }

    public function getDosare(GetDosareQuery $query): DosareCollection
    {
        return $this->dosarService->get($query);
    }

    public function getSedinte(GetSedinteQuery $query): SedinteCollection
    {
        return $this->sedintaService->get($query);
    }
}
