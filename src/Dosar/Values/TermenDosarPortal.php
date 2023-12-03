<?php

namespace Mihaib\PortalJustService\Dosar\Values;

class TermenDosarPortal
{
    public function __construct(
        public string $complet,
        public string $data,
        public string $ora,
        public string $solutie,
        public string $solutieSumar,
        public ?string $dataPronuntare,
        public ?string $documentSedinta,
        public string $numarDocument,
        public ?string $dataDocument,
    ) {
    }
}
