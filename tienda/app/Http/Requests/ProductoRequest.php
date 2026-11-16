<?php

namespace App\Http\Requests;

use App\Filters\ProductFilter;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductoRequest extends FormRequest
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
       /*  return [
            'q'          => ['nullable', 'string', 'max:100'],
            'category'   => ['nullable', 'string', 'max:190'],
            'brand'      => ['nullable', 'string', 'max:255'],
            'price_min'  => ['nullable', 'numeric', 'min:0'],
            'price_max'  => ['nullable', 'numeric', 'min:0', Rule::when($this->filled('price_min'), ['gte:price_min'])],
            'in_stock'   => ['nullable', 'boolean'],
            'on_sale'    => ['nullable', 'boolean'],
            'rating_min' => ['nullable', 'numeric', 'between:1,5'],
            'attr'       => ['nullable', 'array'],
            'attr.*'     => ['string', 'max:255'],
            'sort'       => ['nullable', Rule::in(ProductFilter::SORTS)],
            'per_page'   => ['nullable', 'integer', 'between:1,48'],
            'page'       => ['nullable', 'integer', 'min:1'],
        ]; */
        return [
            'q' => ['nullable', 'string', 'max:100'],
            'per_page' => ['nullable', 'integer', 'between:1,48'],
            'page' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
