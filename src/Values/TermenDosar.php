<?php

namespace Mihaib\PortalJustService\Values;

class Termen
{
    public function __construct(
        public readonly string $complet,
        public readonly string $data,
        public readonly string $ora,
        public readonly string $solutie,
        public readonly string $solutieSumar,
        public readonly ?string $dataPronuntare,
        public readonly ?string $documentSedinta,
        public readonly string $numarDocument,
        public readonly ?string $dataDocument,
    ) {
    }
}
