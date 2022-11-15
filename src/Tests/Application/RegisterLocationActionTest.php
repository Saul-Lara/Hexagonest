<?php declare(strict_types=1);

namespace SaulLara\Hexagonest\Tests\Application;

use PHPUnit\Framework\TestCase;
use SaulLara\Hexagonest\Application\RegisterLocationAction;
use SaulLara\Hexagonest\Domain\LocationRepositoryInterface;
use SaulLara\Hexagonest\Domain\MissingDeviceUuidException;
use SaulLara\Hexagonest\Domain\MissingLatException;
use SaulLara\Hexagonest\Domain\MissingLonException;

final class RegisterLocationActionTest extends TestCase
{
    public function testMissingDeviceUuidExceptionIsThrown()
    {
        $registerLocationAction = new RegisterLocationAction($this->getLocationRespository());

        $this->expectException(MissingDeviceUuidException::class);

        $registerLocationAction->__invoke("", "", "");
    }

    public function testMissingLatExceptionIsThrown()
    {
        $registerLocationAction = new RegisterLocationAction($this->getLocationRespository());

        $this->expectException(MissingLatException::class);

        $registerLocationAction->__invoke("1232312321-67876", "", "");
    }

    public function testMissingLonExceptionIsThrown()
    {
        $registerLocationAction = new RegisterLocationAction($this->getLocationRespository());

        $this->expectException(MissingLonException::class);

        $registerLocationAction->__invoke("1232312321-67876", "90.8887", "");
    }

    public function testRegisterLocationActionFlown()
    {
        $locationRepository = $this->getLocationRespository();
        $locationRepository->expects($this->once())->method('save');
        $registerLocationAction = new RegisterLocationAction($locationRepository);

        $registerLocationAction->__invoke("1232312321-67876", "90.8887", "80.987");
    }

    public function getLocationRespository()
    {
        return $this->createMock(LocationRepositoryInterface::class);
    }
}