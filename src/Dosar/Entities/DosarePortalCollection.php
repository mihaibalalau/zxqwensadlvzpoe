<?php

namespace Mihaib\PortalJustService\Dosar\Entities;

class DosarePortalCollection
{
    /**
     * @param DosarPortal[] $items 
     */
    public function __construct(
        public array $items = []
    ) {
    }
}
