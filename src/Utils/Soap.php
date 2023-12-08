<?php

namespace Mihaib\PortalJustService\Utils;

use stdClass;

class Soap
{
    public static function extractArray(array|stdClass $source): array
    {
        if ($source instanceof stdClass) {
            return [$source];
        }

        return $source;
    }
}
