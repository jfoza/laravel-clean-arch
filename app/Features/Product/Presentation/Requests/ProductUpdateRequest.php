<?php
declare(strict_types=1);

namespace App\Features\Product\Presentation\Requests;

use App\Common\Presentation\Requests\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'description' => 'required|string',
            'details' => 'nullable|string',
            'value' => 'required|numeric',
            'quantity' => 'required|integer',
            'active' => 'required|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'description' => 'Description',
            'details' => 'Details',
            'value' => 'Value',
            'quantity' => 'Quantity',
            'active' => 'Active',
        ];
    }
}
