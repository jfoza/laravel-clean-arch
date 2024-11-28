<?php
declare(strict_types=1);

namespace Tests\Unit\Features\Products\Infra\Database\Eloquent\Mappers;

use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Infra\Database\Eloquent\Mappers\ProductMapper;
use App\Features\Product\Infra\Database\Eloquent\Models\EloquentProductModel;
use App\Libraries\Uuid\Uuid;
use Tests\TestCase;

class ProductMapperTest extends TestCase
{
    private ProductMapper $sut;

    protected function setUp(): void {
        parent::setUp();

        $this->sut = new ProductMapper();
    }

    public function testShouldToMapModelToEntity(): void
    {
        $eloquentModelMock = $this->createMock(EloquentProductModel::class);

        $eloquentModelMock
            ->method('toArray')
            ->willReturn([
                'uuid' => Uuid::v4(),
                'description' => 'Test Product',
                'details' => 'Details',
                'uniqueName' => 'test-product',
                'value' => 10.99,
                'quantity' => 5,
                'active' => true,
                'createdAt' => date('Y-m-d H:i:s'),
            ]);

        $result = $this->sut->from($eloquentModelMock);

        $this->assertInstanceOf(Product::class, $result);
    }
}
