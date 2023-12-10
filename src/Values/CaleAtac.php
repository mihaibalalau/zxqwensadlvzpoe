<?php

namespace Mihaib\PortalJustService\Values;

class CaleAtac
{
    public function __construct(
        public readonly string $dataDeclarare,
        public readonly string $parteDeclaratoare,
        public readonly string $tipCaleAtac,
    ) {
    }
}
