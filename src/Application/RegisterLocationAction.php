<?php declare(strict_types=1);

namespace SaulLara\Hexagonest\Application;

use SaulLara\Hexagonest\Domain\Location;
use SaulLara\Hexagonest\Domain\LocationRepositoryInterface;
use SaulLara\Hexagonest\Domain\MissingDeviceUuidException;
use SaulLara\Hexagonest\Domain\MissingLatException;
use SaulLara\Hexagonest\Domain\MissingLonException;

final class RegisterLocationAction
{
    private LocationRepositoryInterface $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }
    public function __invoke(string $deviceUuid, string $lat, string $lon)
    {
        $this->validate($deviceUuid, $lat, $lon);
        $location = new Location($deviceUuid, $lat, $lon);
        $this->locationRepository->save($location);
    }

    private function validate(string $deviceUuid, string $lat, string $lon)
    {
        if (empty($deviceUuid)) {
            throw new MissingDeviceUuidException();
        }

        if (empty($lat)) {
            throw new MissingLatException();
        }

        if (empty($lon)) {
            throw new MissingLonException();
        }
    }
}