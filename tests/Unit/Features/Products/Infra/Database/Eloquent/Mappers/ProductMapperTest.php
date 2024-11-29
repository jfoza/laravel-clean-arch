<?php
declare(strict_types=1);

namespace Tests\Unit\Features\Products\Infra\Database\Eloquent\Mappers;

use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Props\ProductProps;
use App\Features\Product\Infra\Database\Eloquent\Mappers\EloquentProductMapper;
use App\Features\Product\Infra\Database\Eloquent\Models\EloquentProductModel;
use App\Libraries\Uuid\Uuid;
use Tests\TestCase;

class ProductMapperTest extends TestCase
{
    private EloquentProductMapper $sut;

    protected function setUp(): void {
        parent::setUp();

        $this->sut = new EloquentProductMapper();
        $this->setProtectedProperty($this->sut, 'props', new ProductProps());
    }

    public function testShouldToMapModelToEntity(): void
    {
        $eloquentModelMock = $this->createMock(EloquentProductModel::class);

        $eloquentModelMock
            ->method('offsetGet')
            ->willReturnMap([
                [EloquentProductModel::DESCRIPTION, 'Test Product'],
                [EloquentProductModel::DETAILS, 'Details'],
                [EloquentProductModel::UNIQUE_NAME, 'test-product'],
                [EloquentProductModel::VALUE, 10.99],
                [EloquentProductModel::QUANTITY, 5],
                [EloquentProductModel::UUID, Uuid::v4()],
            ]);

        $result = $this->sut->from($eloquentModelMock);

        $this->assertInstanceOf(Product::class, $result);
    }
}
