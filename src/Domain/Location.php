<?php declare(strict_types=1);

namespace SaulLara\Hexagonest\Domain;

final class Location
{
    private string $deviceUuid;
    private string $lat;
    private string $lon;


    public function __construct(string $deviceUuid, string $lat, string $lon)
    {
        $this->deviceUuid = $deviceUuid;
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function getDeviceUuid(): string
    {
        return $this->deviceUuid;
    }

    public function getLon(): string
    {
        return $this->lon;
    }

    public function getLat(): string
    {
        return $this->lat;
    }
}