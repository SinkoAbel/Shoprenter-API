<?php

namespace App\Http\Interfaces;

interface IXmlSerializable
{
    public function convertToXml(array $data): string;
}
