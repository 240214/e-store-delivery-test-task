<?php

namespace App\Services;

use App\Services\CourierService;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class FedexService implements CourierService
{
    const API_URL = 'https://fedex.test/api/delivery';

	public function sendParcel($parcelData, $recipientData): Response
	{
        // Prepare data for API
        $data = [
            'customer_name' => $recipientData['full_name'],
            'phone_number' => $recipientData['phone_number'],
            'email' => $recipientData['email'],
            'sender_address' => config('app.sender_address'),
            'delivery_address' => $recipientData['address'],
        ];

        $response = Http::post(self::API_URL, $data);

        // Here handling the response from API
        //...

        // or maybe returning $response as is
        return $response;
	}
}
