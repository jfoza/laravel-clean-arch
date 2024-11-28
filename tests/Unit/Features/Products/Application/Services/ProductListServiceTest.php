<?php
declare(strict_types=1);

namespace Tests\Unit\Features\Products\Application\Services;

use App\Common\Domain\Entities\Paginator;
use App\Features\Product\Application\Dto\ProductSearchParamsDto;
use App\Features\Product\Application\Services\ProductListService;
use App\Features\Product\Domain\Repositories\ProductRepositoryInterface;
use Illuminate\Support\Collection;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class ProductListServiceTest extends TestCase
{
    private MockObject|ProductRepositoryInterface $productRepositoryMock;
    private MockObject|ProductSearchParamsDto $productSearchParamsDtoMock;

    private ProductListService $sut;
    private Paginator $paginator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);

        $this->productSearchParamsDtoMock = new ProductSearchParamsDto();

        $this->sut = new ProductListService(
            $this->productRepositoryMock,
        );

        $this->paginator = new Paginator(
            currentPage: 1,
            data: [],
            from: 1,
            lastPage: 1,
            perPage: 10,
            total: 100,
            to: 1,
        );
    }

    public function testShouldReturnPaginatedProductsList()
    {
        $this
            ->productRepositoryMock
            ->method('findAll')
            ->willReturn(Collection::make());

        $this
            ->productRepositoryMock
            ->method('paginate')
            ->willReturn($this->paginator);

        $this->productSearchParamsDtoMock->page = 1;

        $result = $this->sut->execute($this->productSearchParamsDtoMock);

        $this->assertInstanceOf(Paginator::class, $result);
    }

    public function testShouldReturnCollectionProductsList()
    {
        $this
            ->productRepositoryMock
            ->method('findAll')
            ->willReturn(Collection::make());

        $this
            ->productRepositoryMock
            ->method('paginate')
            ->willReturn($this->paginator);

        $this->productSearchParamsDtoMock->page = null;

        $result = $this->sut->execute($this->productSearchParamsDtoMock);

        $this->assertInstanceOf(Collection::class, $result);
    }
}
