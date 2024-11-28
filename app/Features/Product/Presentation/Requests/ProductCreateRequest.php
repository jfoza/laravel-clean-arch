<?php
declare(strict_types=1);

namespace App\Features\Product\Presentation\Requests;

use App\Common\Presentation\Requests\FormRequest;

class ProductCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'description' => 'required|string',
            'details' => 'nullable|string',
            'value' => 'required|numeric',
            'validate' => 'required|date',
            'quantity' => 'required|integer',
        ];
    }

    public function attributes(): array
    {
        return [
            'description' => 'Description',
            'details' => 'Details',
            'value' => 'Value',
            'validate' => 'Validate',
            'quantity' => 'Quantity',
            'active' => 'nullable|boolean',
        ];
    }
}
