<?php
declare(strict_types=1);

namespace Tests\Unit\Features\Products\Application\Services;

use App\Common\Application\Transaction;
use App\Enums\MessagesEnum;
use App\Exceptions\ConflictHttpException;
use App\Features\Product\Application\Dto\ProductCreateDto;
use App\Features\Product\Application\Services\ProductCreateService;
use App\Features\Product\Domain\Dto\ProductCreateDtoInterface;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\Unit\Features\Products\Application\Services\DataBuilder\ProductDataBuilder;

class ProductCreateServiceTest extends TestCase
{
    private MockObject|ProductRepositoryInterface $productRepositoryMock;
    private ProductCreateDtoInterface $productCreateDto;
    private ProductCreateService $sut;

    protected function setUp(): void {
        parent::setUp();

        $this->productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $this->productCreateDto = new ProductCreateDto();

        $this->productCreateDto->description = 'description';
        $this->productCreateDto->details = 'details';
        $this->productCreateDto->value = 29.99;
        $this->productCreateDto->quantity = 10;

        $this->sut = new ProductCreateService($this->productRepositoryMock);
        $this->sut->transaction = $this->createMock(Transaction::class);
    }

    public function testShouldCreateNewProduct(): void
    {
        $this
            ->productRepositoryMock
            ->method('findByName')
            ->willReturn(null);

        $result = $this->sut->execute($this->productCreateDto);

        $this->assertInstanceOf(Product::class, $result);
    }

    public function testShouldReturnExceptionIfProductNameAlreadyExists(): void
    {
        $this
            ->productRepositoryMock
            ->method('findByName')
            ->willReturn(ProductDataBuilder::getProduct());

        $this->expectException(ConflictHttpException::class);
        $this->expectExceptionCode(Response::HTTP_CONFLICT);
        $this->expectExceptionMessage(MessagesEnum::PRODUCT_NAME_ALREADY_EXISTS);

        $this->sut->execute($this->productCreateDto);
    }
}
