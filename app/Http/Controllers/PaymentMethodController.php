<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of all payment methods.
     */
    public function index()
    {
        $methods = PaymentMethod::all();
        return response()->json($methods);
    }

    /**
     * Store a newly created payment method.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:payment_methods,code',
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $method = PaymentMethod::create($validated);

        return response()->json($method, 201);
    }

    /**
     * Display a specific payment method.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        return response()->json($paymentMethod);
    }

    /**
     * Update the specified payment method.
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validated = $request->validate([
            'code' => 'sometimes|string|unique:payment_methods,code,' . $paymentMethod->id,
            'name' => 'sometimes|string',
            'description' => 'nullable|string',
        ]);

        $paymentMethod->update($validated);

        return response()->json($paymentMethod);
    }

    /**
     * Remove the specified payment method.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return response()->json(['message' => 'Payment method deleted successfully']);
    }
}
