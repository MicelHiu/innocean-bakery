<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Validation\Validator;

class StoreSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required', 'string', 'max:255'],
            'store_id'=>['required', 'exists:stores,store_id'],
            'product_id'=>['required','exists:products,product_id'],
        ];
    }

    /* product must be in the same tier as store, checked on the server */
    public function after(): array
    {
        return [function (Validator $validator) {
            if($validator->errors()->hasAny(['store_id', 'product_id'])) {
                return;
            }

            $store = Store::find($this->store_id);
            $product = Product::find($this->product_id);

            if($store->tier_id !== $product->tier_id) {
                $validator->errors()->add('product_id', 'The product is not available for this store tier.');
            }
        }];
    }
}
