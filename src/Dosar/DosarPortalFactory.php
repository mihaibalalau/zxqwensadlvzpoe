<?php

namespace Mihaib\PortalJustService\Dosar;

use stdClass;
use Mihaib\PortalJustService\Utils\Soap;
use Mihaib\PortalJustService\Dosar\Entities\DosarPortal;
use Mihaib\PortalJustService\Dosar\Values\CaleAtacDosarPortal;
use Mihaib\PortalJustService\Dosar\Values\ParteDosarPortal;
use Mihaib\PortalJustService\Dosar\Values\TermenDosarPortal;

class DosarPortalFactory
{
    public static function fromObject(stdClass $data): DosarPortal
    {
        return new DosarPortal(
            $data->numar,
            $data->numarVechi,
            $data->data,
            $data->dataModificare,
            $data->institutie,
            $data->departament,
            $data->categorieCaz,
            $data->stadiuProcesual,
            $data->obiect,
            array_map(fn (stdClass $termen) => new TermenDosarPortal(
                $termen->complet,
                $termen->data,
                $termen->ora,
                $termen->solutie,
                $termen->solutieSumar,
                $termen->dataPronuntare,
                $termen->documentSedinta,
                $termen->numarDocument,
                $termen->dataDocument,
            ), Soap::extractArray($data->sedinte->DosarSedinta ?? [])),
            array_map(fn (stdClass $parte) => new ParteDosarPortal(
                $parte->nume,
                $parte->calitateParte,
            ), Soap::extractArray($data->parti->DosarParte ?? [])),
            array_map(fn (stdClass $caleAtac) => new CaleAtacDosarPortal(
                $caleAtac->dataDeclarare,
                $caleAtac->parteDeclaratoare,
                $caleAtac->tipCaleAtac,
            ), Soap::extractArray($data->caiAtac->DosarCaleAtac ?? []))
        );
    }
}
