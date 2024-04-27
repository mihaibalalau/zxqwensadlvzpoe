<?php

namespace Mihaib\PortalJustService\Services;

use Mihaib\PortalJustService\Collections\CaiAtacCollection;
use Mihaib\PortalJustService\Collections\PartiCollection;
use Mihaib\PortalJustService\Collections\TermeneCollection;
use Mihaib\PortalJustService\Entities\Dosar;
use Mihaib\PortalJustService\Utils\Soap;
use Mihaib\PortalJustService\Values\CaleAtac;
use Mihaib\PortalJustService\Values\Parte;
use Mihaib\PortalJustService\Values\Termen;
use stdClass;

class SoapDosarConverter
{
    public static function convert(stdClass $data): Dosar
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
            new TermeneCollection(array_map([self::class, 'buildTermen'], Soap::extractArray($data->sedinte->DosarSedinta ?? []))),
            new PartiCollection(array_map([self::class, 'buildParte'], Soap::extractArray($data->parti->DosarParte ?? []))),
            new CaiAtacCollection(array_map([self::class, 'buildCaleAtac'], Soap::extractArray($data->caiAtac->DosarCaleAtac ?? [])))
        );
    }

    private static function buildTermen(stdClass $data): Termen
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

    private static function buildParte(stdClass $data): Parte
    {
        return new Parte(
            $data->nume,
            $data->calitateParte,
        );
    }

    private static function buildCaleAtac(stdClass $data): CaleAtac
    {
        return new CaleAtac(
            $data->dataDeclarare,
            $data->parteDeclaratoare,
            $data->tipCaleAtac,
        );
    }
}
