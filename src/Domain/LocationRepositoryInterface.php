<?php declare(strict_types=1);

namespace SaulLara\Hexagonest\Domain;

interface LocationRepositoryInterface
{
    public function save(Location $location): void;
}