<?php
declare(strict_types=1);

namespace App\Features\Product\Presentation\Requests;

use App\Common\Presentation\Requests\FormRequest;

class ProductSearchParamsRequest extends FormRequest
{
    public function rules(): array
    {
        return $this->mergePaginationOrderRules([
            'description' => 'nullable|string',
            'uniqueName' => 'nullable|string',
            'active' => 'nullable|boolean',
        ]);
    }

    public function attributes(): array
    {
        return $this->mergePaginationOrderAttributes([
            'description' => 'Description',
            'uniqueName' => 'Unique name',
            'active' => 'Active',
        ]);
    }
}
