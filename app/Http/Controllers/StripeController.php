<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class StripeController
{
    public function checkout(Request $request)
    {
        $productId = $request->input('product_id');

        $product = Product::find($productId);
        if (! $product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $secret = env('STRIPE_SECRET');
        if (! $secret) {
            return response()->json(['error' => 'Stripe secret key not configured. Set STRIPE_SECRET in .env'], 500);
        }

        // Build parameters for Stripe Checkout Session
        $params = [
            'payment_method_types[]' => 'card',
            'mode' => 'payment',
            'success_url' => url('/shop?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => url('/shop'),
            'line_items[0][price_data][currency]' => 'usd',
            'line_items[0][price_data][product_data][name]' => $product->name,
            'line_items[0][price_data][unit_amount]' => intval($product->price * 100),
            'line_items[0][quantity]' => 1,
        ];

        $ch = curl_init('https://api.stripe.com/v1/checkout/sessions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $secret,
        ]);

        $res = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code >= 200 && $code < 300) {
            $json = json_decode($res, true);
            // Stripe may return a url for redirect
            if (! empty($json['url'])) {
                return response()->json(['url' => $json['url']]);
            }
            // Fallback: return session id so client can use Stripe.js if available
            return response()->json(['session' => $json]);
        }

        return response()->json(['error' => $res], $code ?: 500);
    }
}
