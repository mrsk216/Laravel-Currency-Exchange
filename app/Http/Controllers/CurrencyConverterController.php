<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyConverterController extends Controller
{
    public function index()
    {
        $currencies = ["USD","EUR","JPY","GBP","AUD","CAD","CHF","CNY","INR","BRL","RUB","KRW","ZAR","MXN","SGD","BDT"];       
        return view('convert', compact('currencies'));
    }

    public function convert(Request $request)
    {
        $fromCurrency = $request->fromCurrency;
        $toCurrency = $request->toCurrency;
        $amount = $request->amount;

        $apiKey = env('CURRENCY_API_KEY');
        try {
            $response = Http::get("https://v6.exchangerate-api.com/v6/".$apiKey."pair/{$fromCurrency}/{$toCurrency}");

            $responseData = $response->json();
            if (isset($responseData['conversion_rate'])) {
                $exchangeRate = $responseData['conversion_rate'];
                $convertedAmount = $amount * $exchangeRate;
                return response()->json($convertedAmount);
            } else {
                return response()->json('Exchange rate not available.');
            }
        } catch (\Exception $e) {
            return response()->json('An error occurred while fetching exchange rate.');
        }
    } 
}
