<?php

namespace Mihaib\PortalJustService\Dosar\Values;

class ParteDosarPortal
{
    public function __construct(
        public string $nume,
        public string $calitateParte,
    ) {
    }
}
