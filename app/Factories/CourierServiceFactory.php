<?php

namespace App\Factories;

use App\Services\CourierService;

interface CourierServiceFactory
{
    public function create(string $serviceName): CourierService;
}
