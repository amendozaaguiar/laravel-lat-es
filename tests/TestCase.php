<?php

namespace Amendozaaguiar\LaravelLatEs\Tests;

use Amendozaaguiar\LaravelLatEs\LaravelLatEsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelLatEsServiceProvider::class,
        ];
    }
}
