<?php

namespace App\Services;

interface CourierService
{
    public function sendParcel($parcelData, $recipientData);
}
