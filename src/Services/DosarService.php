<?php

namespace Mihaib\PortalJustService\Services;

use stdClass;
use Mihaib\PortalJustService\Utils\Soap;
use Mihaib\PortalJustService\Values\Parte;
use Mihaib\PortalJustService\Values\Termen;
use Mihaib\PortalJustService\Entities\Dosar;
use Mihaib\PortalJustService\Values\CaleAtac;
use Mihaib\PortalJustService\Queries\GetDosareQuery;
use Mihaib\PortalJustService\Collections\PartiCollection;
use Mihaib\PortalJustService\Collections\DosareCollection;
use Mihaib\PortalJustService\Collections\CaiAtacCollection;
use Mihaib\PortalJustService\Collections\TermeneCollection;

class DosarService
{
    public function __construct(
        private PortalApiClient $portalClient
    ) {
    }

    public function get(GetDosareQuery $query): DosareCollection
    {
        $response = $this->portalClient->getDosare($query);

        if (!isset($response->CautareDosare2Result)) {
            return new DosareCollection();
        }

        $data = $response->CautareDosare2Result->Dosar;

        if (!is_array($data)) {
            $dosare = [$this->buildDosar($data)];
        } else {
            $dosare = array_map([$this, 'buildDosar'], $data);
        }

        return new DosareCollection($dosare);
    }

    private function buildDosar(stdClass $data): Dosar
    {
        return new Dosar(
            $data->numar,
            $data->numarVechi,
            $data->data,
            $data->dataModificare,
            $data->institutie,
            $data->departament,
            $data->categorieCaz,
            $data->stadiuProcesual,
            $data->obiect,
            new TermeneCollection(array_map([$this, 'buildTermen'], Soap::extractArray($data->sedinte->DosarSedinta ?? []))),
            new PartiCollection(array_map([$this, 'buildParte'], Soap::extractArray($data->parti->DosarParte ?? []))),
            new CaiAtacCollection(array_map([$this, 'buildCaleAtac'], Soap::extractArray($data->caiAtac->DosarCaleAtac ?? [])))
        );
    }

    private function buildTermen(stdClass $data): Termen
    {
        return new Termen(
            $data->complet,
            $data->data,
            $data->ora,
            $data->solutie,
            $data->solutieSumar,
            $data->dataPronuntare,
            $data->documentSedinta,
            $data->numarDocument,
            $data->dataDocument,
        );
    }

    private function buildParte(stdClass $data): Parte
    {
        return new Parte(
            $data->nume,
            $data->calitateParte,
        );
    }

    private function buildCaleAtac(stdClass $data): CaleAtac
    {
        return new CaleAtac(
            $data->dataDeclarare,
            $data->parteDeclaratoare,
            $data->tipCaleAtac,
        );
    }
}
