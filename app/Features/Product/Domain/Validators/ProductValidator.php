<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\Validators;

use App\Common\Domain\Exceptions\InvalidArgumentException;
use App\Features\Product\Domain\Props\ProductProps;
use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductValidator
{
    /**
     * @throws InvalidArgumentException|ValidationException
     */
    public static function validate(ProductProps $props): array
    {
        $data = get_object_vars($props);

        $rules = [
            'description' => 'required|string|max:255',
            'details' => 'nullable|string|max:500',
            'uniqueName' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!$value instanceof UniqueProductDescription) {
                        $fail("The $attribute is invalid.");
                    }
                },
            ],
            'value' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'active' => 'required|boolean',
            'createdAt' => 'nullable|date'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->all());
        }

        return $validator->validated();
    }
}
