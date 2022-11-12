<?php declare(strict_types=1);

namespace SaulLara\Hexagonest\Infrastructure;

use SaulLara\Hexagonest\Domain\Location;
use SaulLara\Hexagonest\Domain\LocationRepositoryInterface;

final class LocationRepositoryMariaDB implements LocationRepositoryInterface
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Location $location): void
    {
        $statement = $this->pdo->prepare("
            INSERT INTO locations (device_uuid, lat, lon) VALUES (:device_uuid, :lat, :lon)
        ");
        $statement->execute([
            "device_uuid" => $location->getDeviceUuid(),
            "lat" => $location->getLat(),
            "lon" => $location->getLon()
        ]);
    }

}