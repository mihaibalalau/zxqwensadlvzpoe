<?php

namespace Mihaib\PortalJustService\Queries;

use Mihaib\PortalJustService\Exceptions\InvalidQueryException;

class GetDosareQuery
{
    public function __construct(
        public readonly ?string $numarDosar = null,
        public readonly ?string $obiectDosar = null,
        public readonly ?string $numeParte = null,
        public readonly ?string $institutie = null,
        public readonly ?string $dataStart = null,
        public readonly ?string $dataStop = null,
        public readonly ?string $dataUltimaModificareStart = null,
        public readonly ?string $dataUltimaModificareStop = null,
    ) {
        if (!$this->isValid()) {
            throw new InvalidQueryException();
        }
    }

    public function isValid(): bool
    {
        return isset($numarDosar) ||
            isset($obiectDosar) ||
            isset($numeParte);
    }
}
