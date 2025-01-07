<?php
declare(strict_types=1);

namespace Tests\Unit\Features\Products\Application\Services;

use App\Enums\MessagesEnum;
use App\Exceptions\NotFoundHttpException;
use App\Features\Product\Application\Services\ProductListByUuidService;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Libraries\Uuid\Uuid;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\Unit\Features\Products\Application\Services\DataBuilder\ProductDataBuilder;

class ProductListByUuidServiceTest extends TestCase
{
    private MockObject|ProductRepositoryInterface $productRepositoryMock;
    private ProductListByUuidService $sut;

    protected function setUp(): void {
        parent::setUp();

        $this->productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $this->sut = new ProductListByUuidService($this->productRepositoryMock);
    }

    public function testShouldReturnUniqueProductByUuid(): void
    {
        $this
            ->productRepositoryMock
            ->method('findByUuid')
            ->willReturn(ProductDataBuilder::getProduct());

        $result = $this->sut->execute(Uuid::v4());

        $this->assertInstanceOf(Product::class, $result);
    }

    public function testShouldReturnExceptionIfProductNotExists(): void
    {
        $this
            ->productRepositoryMock
            ->method('findByUuid')
            ->willReturn(null);

        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionCode(Response::HTTP_NOT_FOUND);
        $this->expectExceptionMessage(MessagesEnum::PRODUCT_NOT_EXISTS);

        $this->sut->execute(Uuid::v4());
    }
}
