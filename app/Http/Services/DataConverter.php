<?php

namespace App\Http\Services;

use App\Http\Interfaces\IConvertable;
use Spatie\ArrayToXml\ArrayToXml;

final class DataConverter implements IConvertable
{
    /**
     * Accepted headers.
     *
     * @var array<string, string>
     */
    private static array $acceptHeaderTypes = [
        'json' => 'application/json',
        'xml' => 'application/xml',
    ];

    /**
     * Convert data array to Json.
     *
     * @param array $data
     * @return string
     */
    public function convertToJson(array $data): string
    {
        return json_encode($data);
    }

    /**
     * Convert data array to Xml.
     *
     * @param array $data
     * @return string
     */
    public function convertToXml(array $data): string
    {
        return ArrayToXml::convert($data);
    }

    /**
     * Convert the data array to the
     * chosen return format.
     *
     * @param string $acceptHeader
     * @param array $data
     * @return string
     */
    public function decideConversion(string $acceptHeader, array $data): string
    {
        return match ($acceptHeader) {
            self::$acceptHeaderTypes['xml'] => $this->convertToXml($data),
            default => $this->convertToJson($data),
        };
    }
}
