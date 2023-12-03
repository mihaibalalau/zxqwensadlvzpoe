<?php

namespace Mihaib\PortalJustService\Dosar\Entities;

class DosarPortalCollection
{
    /**
     * @param DosarPortal[] $items 
     */
    public function __construct(
        public array $items = []
    ) {
    }
}
