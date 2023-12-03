<?php

namespace Mihaib\PortalJustService\Dosar;

class GetDosarePortalQuery
{
    public function __construct(
        public ?string $numarDosar = null,
        public ?string $obiectDosar = null,
        public ?string $numeParte = null,
        public ?string $institutie = null,
        public ?string $dataStart = null,
        public ?string $dataStop = null,
        public ?string $dataUltimaModificareStart = null,
        public ?string $dataUltimaModificareStop = null,
    ) {
    }

    public function isValid(): bool
    {
        return !isset($numarDosar) &&
            !isset($obiectDosar) &&
            !isset($numeParte);
    }

    public function toArray(): array
    {
        return [
            'numarDosar' => $this->numarDosar,
            'obiectDosar' => $this->obiectDosar,
            'numeParte' => $this->numeParte,
            'institutie' => $this->institutie,
            'dataStart' => $this->dataStart,
            'dataStop' => $this->dataStop,
            'dataUltimaModificareStart' => $this->dataUltimaModificareStart,
            'dataUltimaModificareStop' => $this->dataUltimaModificareStop,
        ];
    }
}
