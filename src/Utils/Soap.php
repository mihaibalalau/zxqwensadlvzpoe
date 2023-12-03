<?php

namespace Mihaib\PortalJustService\Utils;

use stdClass;

class Soap
{
    public static function extractArray(array|stdClass $source): array
    {
        if (count($source) && !array_is_list($source)) {
            return [$source];
        }

        return $source;
    }
}
