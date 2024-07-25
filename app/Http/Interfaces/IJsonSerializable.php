<?php

namespace App\Http\Interfaces;

interface IJsonSerializable
{
    public function convertToJson(array $data): string;
}
