<?php

namespace App\Factories;

use App\Factories\CourierServiceFactory;
use App\Services\CourierService;
use App\Services\FedexService;
use App\Services\DHLService;

class DeliveryCourierServiceFactory implements CourierServiceFactory
{
    public function create(string $serviceName): CourierService
    {
        switch ($serviceName) {
            case 'fedex':
                return new FedexService();
            case 'dhl':
                return new DHLService();
            // Adding another courier services here.
            default:
                throw new \InvalidArgumentException("Unsupported courier service: $serviceName");
        }
    }

}
