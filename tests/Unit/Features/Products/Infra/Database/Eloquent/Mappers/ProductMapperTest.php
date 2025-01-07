<?php
declare(strict_types=1);

namespace Tests\Unit\Features\Products\Infra\Database\Eloquent\Mappers;

use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Infra\Database\Eloquent\Mappers\EloquentProductMapper;
use App\Features\Product\Infra\Database\Eloquent\Models\EloquentProductModel;
use App\Libraries\Uuid\Uuid;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ProductMapperTest extends TestCase
{
    private EloquentProductMapper $sut;

    protected function setUp(): void {
        parent::setUp();

        $this->sut = new EloquentProductMapper();
    }

    public function testFromMethodShouldToMapModelToEntity(): void
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

    public function testOptionalMethodShouldToMapModelToEntity(): void
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

        $result = $this->sut->optional($eloquentModelMock);

        $this->assertInstanceOf(Product::class, $result);
    }

    public function testCollectionMethodShouldToMapModelToEntity(): void
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

        $result = $this->sut->collection(Collection::make($eloquentModelMock->toArray()));

        $this->assertInstanceOf(Collection::class, $result);

        $result->each(fn($item) => $this->assertInstanceOf(Product::class, $item));    }

    public function testOptionalMethodShouldReturnNull(): void
    {
        $result = $this->sut->optional();

        $this->assertNull($result);
    }
}
