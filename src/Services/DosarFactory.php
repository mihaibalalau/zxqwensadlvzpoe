<?php

namespace Mihaib\PortalJustService\Services;

use Mihaib\PortalJustService\Entities\Dosar;
use SimpleXMLElement;
use stdClass;

class DosarFactory
{
    public static function fromXML(SimpleXMLElement $xml): Dosar
    {
        return XmlDosarConverter::convert($xml);
    }

    public static function fromSoap(stdClass $data): Dosar
    {
        return SoapDosarConverter::convert($data);
    }
}
