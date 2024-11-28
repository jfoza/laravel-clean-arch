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
     * @throws ValidationException|InvalidArgumentException
     */
    public static function normalize(array $data): ProductProps {
        $validated = self::validate($data);

        $productProps = new ProductProps();
        $productProps->description = $validated['description'];
        $productProps->details = $validated['details'] ?? null;
        $productProps->uniqueName = $validated['uniqueName'];
        $productProps->value = $validated['value'];
        $productProps->quantity = $validated['quantity'];
        $productProps->active = $validated['active'];
        $productProps->createdAt = $validated['createdAt'] ?? null;

        return $productProps;
    }

    /**
     * @throws InvalidArgumentException|ValidationException
     */
    public static function validate(array $data): array
    {
        $rules = [
            'description' => 'required|string|max:255',
            'details' => 'nullable|string|max:500',
            'uniqueName' => ['required', function ($attribute, $value, $fail) {
                if (!$value instanceof UniqueProductDescription) {
                    $fail("The field $attribute is invalid.");
                }
            }],
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
