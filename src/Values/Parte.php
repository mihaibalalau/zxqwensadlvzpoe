<?php

namespace Mihaib\PortalJustService\Values;

class Parte
{
    public function __construct(
        public readonly string $nume,
        public readonly string $calitateParte,
    ) {
    }
}
