<?php

namespace Mihaib\PortalJustService\Dosar\Entities;

use Mihaib\PortalJustService\Dosar\Values\CaleAtacDosarPortal;
use Mihaib\PortalJustService\Dosar\Values\ParteDosarPortal;
use Mihaib\PortalJustService\Dosar\Values\TermenDosarPortal;

/**
 * @property TermenDosarPortal[] $termene
 * @property ParteDosarPortal[] $parti
 * @property CaleAtacDosarPortal[] $caiAtac
 */
class DosarPortal
{
    public function __construct(
        public string $numar,
        public ?string $numarVechi,
        public string $data,
        public string $dataModificare,
        public string $institutie,
        public string $departament,
        public string $categorieCaz,
        public string $stadiuProcesual,
        public string $obiect,
        public array $termene,
        public array $parti,
        public array $caiAtac,
    ) {
    }

    public static function termen(
        string $complet,
        string $data,
        string $ora,
        string $solutie,
        string $solutieSumar,
        ?string $dataPronuntare,
        ?string $documentSedinta,
        string $numarDocument,
        ?string $dataDocument,
    ): TermenDosarPortal {
        return new TermenDosarPortal(
            $complet,
            $data,
            $ora,
            $solutie,
            $solutieSumar,
            $dataPronuntare,
            $documentSedinta,
            $numarDocument,
            $dataDocument,
        );
    }

    public static function parte(
        string $nume,
        string $calitateParte,
    ): ParteDosarPortal {
        return new ParteDosarPortal(
            $nume,
            $calitateParte,
        );
    }

    public static function caleAtac(
        string $data,
        string $tip,
        string $numeParteDeclaranta,
    ): CaleAtacDosarPortal {
        return new CaleAtacDosarPortal(
            $data,
            $tip,
            $numeParteDeclaranta,
        );
    }
}
