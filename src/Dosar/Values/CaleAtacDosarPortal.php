<?php

namespace Mihaib\PortalJustService\Dosar\Values;

class CaleAtacDosarPortal
{
    public function __construct(
        public string $dataDeclarare,
        public string $parteDeclaratoare,
        public string $tipCaleAtac,
    ) {
    }
}
