<?php

namespace Mihaib\PortalJustService\Values;

class DosarSedinta
{
    public function __construct(
        public readonly string $numar,
        public readonly string $numarVechi,
        public readonly string $data,
        public readonly string $ora,
        public readonly string $categorieCaz,
        public readonly string $stadiuProcesual,
        public readonly string $categorieCazNume,
        public readonly string $stadiuProcesualNume,
    ) {
    }
}
