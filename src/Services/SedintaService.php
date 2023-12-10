<?php

namespace Mihaib\PortalJustService\Services;

use stdClass;
use Mihaib\PortalJustService\Utils\Soap;
use Mihaib\PortalJustService\Entities\Sedinta;
use Mihaib\PortalJustService\Values\DosarSedinta;
use Mihaib\PortalJustService\Queries\GetSedinteQuery;
use Mihaib\PortalJustService\Collections\SedinteCollection;
use Mihaib\PortalJustService\Collections\DosareSedintaCollection;

class SedintaService
{
    public function __construct(
        private PortalApiClient $portalClient
    ) {
    }

    public function get(GetSedinteQuery $query): SedinteCollection
    {
        $response = $this->portalClient->getSedinte($query);

        if (!isset($response->CautareSedinteResult)) {
            return new SedinteCollection();
        }

        return new SedinteCollection(array_map([$this, 'buildSedinta'], $response->CautareSedinteResult->Sedinta));
    }

    private function buildSedinta(stdClass $data): Sedinta
    {
        return new Sedinta(
            $data->departament,
            $data->complet,
            $data->data,
            $data->ora,
            new DosareSedintaCollection(
                array_map(
                    [$this, 'buildDosarSedinte'],
                    Soap::extractArray($data->dosare ?? [])
                )
            )
        );
    }

    private function buildDosarSedinte(stdClass $data): DosarSedinta
    {
        return new DosarSedinta(
            $data->numar,
            $data->numar_vechi,
            $data->data,
            $data->ora,
            $data->categorieCaz,
            $data->stadiuProcesual,
            $data->categorieCazNume,
            $data->stadiuProcesualNume,
        );
    }
}
