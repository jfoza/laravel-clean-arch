<?php
declare(strict_types=1);

namespace App\Features\Product\Domain\ValueObjects;

readonly class UniqueProductDescription
{
    public function __construct(private string $uniqueName)
    {
    }

    public static function create(string $description): UniqueProductDescription
    {
        $normalized = self::normalize($description);
        return new self($normalized);
    }

    public function toString(): string
    {
        return $this->uniqueName;
    }

    private static function normalize(string $string): string
    {
        $string = strtolower(self::removeAccents($string));
        $string = preg_replace('/[^a-z0-9\s]/', '', $string);
        return preg_replace('/\s+/', '-', trim($string));
    }

    private static function removeAccents(string $string): string
    {
        $search = ['À', 'Á', 'Ã', 'Â', 'Ä', 'É', 'Ê', 'È', 'Ë', 'Í', 'Ì', 'Î', 'Ï', 'Ó', 'Õ', 'Ô', 'Ö', 'Ú', 'Ù', 'Û', 'Ü', 'Ç',
            'à', 'á', 'ã', 'â', 'ä', 'é', 'ê', 'è', 'ë', 'í', 'ì', 'î', 'ï', 'ó', 'õ', 'ô', 'ö', 'ú', 'ù', 'û', 'ü', 'ç'];
        $replace = ['A', 'A', 'A', 'A', 'A', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'C',
            'a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'c'];
        return str_replace($search, $replace, $string);
    }
}
