<?php

namespace Mihaib\PortalJustService\Entities;

use Mihaib\PortalJustService\Collections\DosareSedintaCollection;

class Sedinta
{
    public function __construct(
        public readonly string $departament,
        public readonly string $complet,
        public readonly string $data,
        public readonly string $ora,
        public readonly DosareSedintaCollection $dosare,
    ) {
    }
}
