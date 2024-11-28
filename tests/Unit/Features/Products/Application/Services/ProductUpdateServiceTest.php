<?php
declare(strict_types=1);

namespace Tests\Unit\Features\Products\Application\Services;

use App\Common\Application\Exceptions\AppException;
use App\Common\Application\Transaction;
use App\Enums\MessagesEnum;
use App\Features\Product\Application\Dto\ProductUpdateDto;
use App\Features\Product\Application\Services\ProductUpdateService;
use App\Features\Product\Domain\Dto\ProductUpdateDtoInterface;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Libraries\Uuid\Uuid;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\Unit\Features\Products\Application\Services\DataBuilder\ProductDataBuilder;

class ProductUpdateServiceTest extends TestCase
{
    private MockObject|ProductRepositoryInterface $productRepositoryMock;
    private ProductUpdateDtoInterface $productUpdateDto;
    private ProductUpdateService $sut;

    protected function setUp(): void {
        parent::setUp();

        $this->productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $this->productUpdateDto = new ProductUpdateDto();

        $this->productUpdateDto->description = 'description';
        $this->productUpdateDto->details = 'details';
        $this->productUpdateDto->value = 29.99;
        $this->productUpdateDto->quantity = 10;
        $this->productUpdateDto->active = false;

        $this->sut = new ProductUpdateService($this->productRepositoryMock);
        $this->sut->transaction = $this->createMock(Transaction::class);
    }

    public function testShouldCreateNewProduct(): void
    {
        $product = ProductDataBuilder::getProduct();

        $this
            ->productRepositoryMock
            ->method('findByUuid')
            ->willReturn($product);

        $this
            ->productRepositoryMock
            ->method('findByName')
            ->willReturn($product);

        $result = $this->sut->execute($product->uuid, $this->productUpdateDto);

        $this->assertInstanceOf(Product::class, $result);
    }

    public function testShouldReturnExceptionIfProductNotExists(): void
    {
        $this
            ->productRepositoryMock
            ->method('findByUuid')
            ->willReturn(null);

        $this->expectException(AppException::class);
        $this->expectExceptionCode(Response::HTTP_NOT_FOUND);
        $this->expectExceptionMessage(json_encode(MessagesEnum::PRODUCT_NOT_EXISTS));

        $this->sut->execute(Uuid::v4(), $this->productUpdateDto);
    }

    public function testShouldReturnExceptionIfProductNameAlreadyExists(): void
    {
        $product1 = ProductDataBuilder::getProduct();
        $product2 = ProductDataBuilder::getProduct();

        $this
            ->productRepositoryMock
            ->method('findByUuid')
            ->willReturn($product1);

        $this
            ->productRepositoryMock
            ->method('findByName')
            ->willReturn($product2);

        $this->expectException(AppException::class);
        $this->expectExceptionCode(Response::HTTP_CONFLICT);
        $this->expectExceptionMessage(json_encode(MessagesEnum::PRODUCT_NAME_ALREADY_EXISTS));

        $this->sut->execute(Uuid::v4(), $this->productUpdateDto);
    }
}
