<?php

namespace App\Http\Controllers;

use App\Integration\IntegrationProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller
{
    public function registerCustomer(Request $request, IntegrationProvider $provider)
    {
        try {
            $fields = [
                'document' => $request->input('document'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone')
            ];

            $resp = $provider->registerCustomer($fields);

            return response()->json($resp);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['success' => 0, 'code' => 500, 'message' => $ex->getMessage(), 'data' => []]);
        }
    }

    public function rechargeWallet(Request $request, IntegrationProvider $provider)
    {
        try {
            $fields = [
                'document' => $request->input('document'),
                'phone' => $request->input('phone'),
                'amount' => $request->input('amount')
            ];

            $resp = $provider->rechargeWallet($fields);

            return response()->json($resp);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['success' => 0, 'code' => 500, 'message' => $ex->getMessage(), 'data' => []]);
        }
    }

    public function makePayment(Request $request, IntegrationProvider $provider)
    {
        try {
            $fields = [
                'document' => $request->input('document'),
                'phone' => $request->input('phone'),
                'amount' => $request->input('amount')
            ];

            $resp = $provider->makePayment($fields);

            return response()->json($resp);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['success' => 0, 'code' => 500, 'message' => $ex->getMessage(), 'data' => []]);
        }
    }

    public function confirmPayment(Request $request, IntegrationProvider $provider)
    {
        try {
            $fields = [
                'session_id' => $request->input('session_id'),
                'token' => $request->input('token')
            ];

            $resp = $provider->confirmPayment($fields);

            return response()->json($resp);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['success' => 0, 'code' => 500, 'message' => $ex->getMessage(), 'data' => []]);
        }
    }

    public function checkBalance(Request $request, IntegrationProvider $provider)
    {
        try {
            $resp = $provider->checkBalance(['document' => $request->get('document'), 'phone' => $request->get('phone')]);

            return response()->json($resp);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response()->json(['success' => 0, 'code' => 500, 'message' => $ex->getMessage(), 'data' => []]);
        }
    }
}
