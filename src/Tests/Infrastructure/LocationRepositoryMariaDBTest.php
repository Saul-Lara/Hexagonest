<?php declare(strict_types=1);

namespace Infrastructure;

use PHPUnit\Framework\TestCase;
use SaulLara\Hexagonest\Domain\Location;
use SaulLara\Hexagonest\Infrastructure\LocationRepositoryMariaDB;

final class LocationRepositoryMariaDBTest extends TestCase
{
    public function testSave()
    {
        $repository = $this->getRepository();

        $location = $this->getLocationObject();

        $repository->save($location);

        $this->assertTrue($this->existsInDatabaseMariaDB($location), "El objeto no existe en la base de datos");

        $this->deleteLocationObject($location);
    }

    private function getRepository(): LocationRepositoryMariaDB
    {
        return new LocationRepositoryMariaDB($this->getPDO());
    }

    private function getPDO(): \PDO
    {
        $dsn = "mysql:dbname=" . $_ENV['DB_DATABASE'] . ";host=" . $_ENV['DB_HOST'];

        return new \PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }

    private function getLocationObject(): Location
    {
        return new Location("asadasdads", "12.2313", "45.42423");
    }

    private function existsInDatabaseMariaDB(Location $location): bool
    {
        $stmt = $this->getPDO()->prepare("SELECT * 
        FROM locations
        WHERE device_uuid = :device_uuid AND lat = :lat AND lon = :lon");

        $stmt->bindValue(":device_uuid", $location->getDeviceUuid());
        $stmt->bindValue(":lat", $location->getLat());
        $stmt->bindValue(":lon", $location->getLon());

        $stmt->execute();

        return $stmt->rowCount() == 1;
    }

    protected function deleteLocationObject(Location $location): void
    {
        $stmt = $this->getPDO()->prepare("DELETE FROM locations WHERE device_uuid = :device_uuid");
        $stmt->bindValue(":device_uuid", $location->getDeviceUuid());
        $stmt->execute();
    }
}