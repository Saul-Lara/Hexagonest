<?php declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;
use Spatie\Ignition\Ignition;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

/**
 * Register the error handler
 */
Ignition::make()
    ->shouldDisplayException($_ENV['APP_ENV'] !== 'prod')
    ->useDarkMode()
    ->register();