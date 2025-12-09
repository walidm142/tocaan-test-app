<?php

namespace App\Api\V1\Orders\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'items' => 'required|array',
            'items.*.product_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',

        ];
    }

    public function passedValidation()
    {
        // calculate item total price and order total price
        $items = $this->input('items', []);
        $totalPrice = 0;
        $itemTotalPrice = 0;

        foreach ($items as $key => $item) {
            $itemTotalPrice += $item['price'] * $item['quantity'];
            $items[$key]['total_price'] = $itemTotalPrice;
            $totalPrice += $itemTotalPrice;
        }

        $this->merge([
            'total_price' => $totalPrice,
            'items' => $items,
            'user_id' => auth('api')->id(),
        ]);
    }


}
