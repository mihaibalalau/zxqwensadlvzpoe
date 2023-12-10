<?php

namespace Mihaib\PortalJustService\Entities;

use Mihaib\PortalJustService\Collections\CaiAtacCollection;
use Mihaib\PortalJustService\Collections\PartiCollection;
use Mihaib\PortalJustService\Collections\PartiPortalCollection;
use Mihaib\PortalJustService\Collections\TermeneCollection;
use Mihaib\PortalJustService\Dosar\Values\CaleAtac;
use Mihaib\PortalJustService\Dosar\Values\Parte;
use Mihaib\PortalJustService\Dosar\Values\Termen;

/**
 * @property Termen[] $termene
 * @property Parte[] $parti
 * @property CaleAtac[] $caiAtac
 */
class Dosar
{
    public function __construct(
        public readonly string $numar,
        public readonly ?string $numarVechi,
        public readonly string $data,
        public readonly string $dataModificare,
        public readonly string $institutie,
        public readonly string $departament,
        public readonly string $categorieCaz,
        public readonly string $stadiuProcesual,
        public readonly string $obiect,
        public readonly TermeneCollection $termene,
        public readonly PartiCollection $parti,
        public readonly CaiAtacCollection $caiAtac,
    ) {
    }
}
