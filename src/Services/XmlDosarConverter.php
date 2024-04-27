<?php

namespace Mihaib\PortalJustService\Services;

use Mihaib\PortalJustService\Collections\CaiAtacCollection;
use Mihaib\PortalJustService\Collections\PartiCollection;
use Mihaib\PortalJustService\Collections\TermeneCollection;
use Mihaib\PortalJustService\Entities\Dosar;
use Mihaib\PortalJustService\Values\CaleAtac;
use Mihaib\PortalJustService\Values\Parte;
use Mihaib\PortalJustService\Values\Termen;
use SimpleXMLElement;

class XmlDosarConverter
{
    public static function convert(SimpleXMLElement $data): Dosar
    {
        return new Dosar(
            $data->numar,
            $data->numarVechi ?? null,
            $data->data,
            $data->dataModificare,
            $data->institutie,
            $data->departament,
            $data->categorieCaz,
            $data->stadiuProcesual,
            $data->obiect,
            new TermeneCollection(array_map([self::class, 'buildTermen'], self::extractArray($data->sedinte, 'DosarSedinta'))),
            new PartiCollection(array_map([self::class, 'buildParte'], self::extractArray($data->parti, 'DosarParte'))),
            new CaiAtacCollection(array_map([self::class, 'buildCaleAtac'], self::extractArray($data->caiAtac, 'DosarCaleAtac')))
        );
    }

    private static function buildTermen(SimpleXMLElement $data): Termen
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

    private static function buildParte(SimpleXMLElement $data): Parte
    {
        return new Parte(
            $data->nume,
            $data->calitateParte,
        );
    }

    private static function buildCaleAtac(SimpleXMLElement $data): CaleAtac
    {
        return new CaleAtac(
            $data->dataDeclarare,
            $data->parteDeclaratoare,
            $data->tipCaleAtac,
        );
    }

    private static function extractArray(SimpleXMLElement $data, string $key): array
    {
        if ($data->$key === null) {
            return [];
        }

        $arr = [];

        foreach ($data->$key as $item) {
            $arr[] = $item;
        }

        return $arr;
    }
}
