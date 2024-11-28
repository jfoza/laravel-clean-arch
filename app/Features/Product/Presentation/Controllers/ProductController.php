<?php

namespace App\Features\Product\Presentation\Controllers;

use App\Features\Product\Application\Dto\ProductCreateDto;
use App\Features\Product\Application\Dto\ProductSearchParamsDto;
use App\Features\Product\Application\Dto\ProductUpdateDto;
use App\Features\Product\Domain\Services\ProductCreateServiceInterface;
use App\Features\Product\Domain\Services\ProductListByUuidServiceInterface;
use App\Features\Product\Domain\Services\ProductListServiceInterface;
use App\Features\Product\Domain\Services\ProductRemoveServiceInterface;
use App\Features\Product\Domain\Services\ProductUpdateServiceInterface;
use App\Features\Product\Presentation\Requests\ProductCreateRequest;
use App\Features\Product\Presentation\Requests\ProductSearchParamsRequest;
use App\Features\Product\Presentation\Requests\ProductUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

readonly class ProductController
{
    public function __construct(
        private ProductListServiceInterface       $productListService,
        private ProductListByUuidServiceInterface $productListByUuidService,
        private ProductCreateServiceInterface     $productCreateService,
        private ProductUpdateServiceInterface     $productUpdateService,
        private ProductRemoveServiceInterface     $productRemoveService,
    )
    {
    }

    public function index(
        ProductSearchParamsRequest $request,
        ProductSearchParamsDto $dto
    ): JsonResponse
    {
        $dto->page = $request->page;
        $dto->perPage = $request->perPage;
        $dto->columnName = $request->columnName;
        $dto->columnOrder = $request->columnOrder;

        $dto->description = $request->description;
        $dto->uniqueName = $request->uniqueName;
        $dto->active = $request->active;

        $result = $this->productListService->execute($dto);

        return response()->json($result, Response::HTTP_OK);
    }

    public function show(Request $request): JsonResponse
    {
        $uuid = $request->uuid;

        $result = $this->productListByUuidService->execute($uuid);

        return response()->json($result, Response::HTTP_OK);
    }

    public function insert(ProductCreateRequest $request, ProductCreateDto $dto): JsonResponse
    {
        $dto->description = $request->description;
        $dto->details = $request->details;
        $dto->validate = $request->validate;
        $dto->value = $request->value;
        $dto->quantity = $request->quantity;

        $result = $this->productCreateService->execute($dto);

        return response()->json($result, Response::HTTP_CREATED);
    }

    public function update(ProductUpdateRequest $request, ProductUpdateDto $dto): JsonResponse
    {
        $uuid = $request->uuid;
        $dto->description = $request->description;
        $dto->details = $request->details;
        $dto->validate = $request->validate;
        $dto->value = $request->value;
        $dto->quantity = $request->quantity;
        $dto->active = $request->active;

        $result = $this->productUpdateService->execute($uuid, $dto);

        return response()->json($result, Response::HTTP_CREATED);
    }

    public function delete(Request $request): JsonResponse
    {
        $uuid = $request->uuid;

        $this->productRemoveService->execute($uuid);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
