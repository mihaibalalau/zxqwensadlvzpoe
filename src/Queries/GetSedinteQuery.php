<?php

namespace Mihaib\PortalJustService\Queries;

class GetSedinteQuery
{
    public function __construct(
        public readonly string $dataSedinta,
        public readonly string $institutie,
    ) {
    }
}
