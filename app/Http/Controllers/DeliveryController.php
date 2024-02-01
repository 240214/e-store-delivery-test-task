<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use App\Factories\CourierServiceFactory;

class DeliveryController extends Controller
{
    protected $courierServiceFactory;

    /**
     * @param CourierServiceFactory $courierServiceFactory
     */
    public function __construct(CourierServiceFactory $courierServiceFactory)
    {
        $this->courierServiceFactory = $courierServiceFactory;
    }

    /**
     * The function should work via AJAX request
     * The incoming JSON data should look like this
     * {
     *     parcel: {
     *         width: int,
     *         height: int,
     *         length: int,
     *         weight: int,
     *     },
     *     recipient: {
     *         customer_name: string,
     *         phone_number: string,
     *         email: string,
     *         delivery_address: string,
     *     },
     * }
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sendParcelData(Request $request): JsonResponse
    {
        // Validate incoming request data
        $this->validateJsonData($request, [
            'parcel.width' => 'required|numeric',
            'parcel.height' => 'required|numeric',
            'parcel.length' => 'required|numeric',
            'parcel.weight' => 'required|numeric',
            'recipient.customer_name' => 'required|string',
            'recipient.phone_number' => 'required|string',
            'recipient.email' => 'required|email',
            'recipient.delivery_address' => 'required|string',
        ]);

        // Extract data from the request
        $serviceName = $request->input('service_name');
        $parcelData = $request->input('parcel');
        $recipientData = $request->input('recipient');

        // Creating a courier service dynamically
        $courierService = $this->courierServiceFactory->create($serviceName);

        // Sending data via selected courier service
        $response = $courierService->sendParcel($parcelData, $recipientData);

        // Here is additional processing of the response from the API if necessary.
        // It may be necessary to call some additional methods in this class.
        //...

        // Return a response to the client
        return response()->json(['message' => 'Parcel data sent to FedEx']);
    }

    protected function validateJsonData(Request $request, array $rules)
    {
        try {
            $this->validate($request, $rules);
        } catch (ValidationException $exception) {
            $jsonErrors = [
                'errors' => $exception->errors(),
                'message' => 'The given data was invalid.',
            ];

            // Returning validation errors in JSON format with code 422
            return response()->json($jsonErrors, 422);
        }
    }


}
