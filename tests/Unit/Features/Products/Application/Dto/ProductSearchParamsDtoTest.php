<?php
declare(strict_types=1);

namespace Tests\Unit\Features\Products\Application\Dto;

use App\Features\Product\Application\Dto\ProductSearchParamsDto;
use Tests\TestCase;

class ProductSearchParamsDtoTest extends TestCase
{
    private ProductSearchParamsDto $sut;

    protected function setUp(): void {
        parent::setUp();
        $this->sut = new ProductSearchParamsDto();
    }

    public function testDescriptionField()
    {
        $this->sut->description = 'Test Description';

        $this->assertEquals('Test Description', $this->sut->description);
        $this->assertIsString($this->sut->description);
    }

    public function testUniqueNameField()
    {
        $this->sut->uniqueName = 'test-description';

        $this->assertEquals('test-description', $this->sut->uniqueName);
        $this->assertIsString($this->sut->uniqueName);
    }

    public function testActiveField()
    {
        $this->sut->active = true;

        $this->assertTrue($this->sut->active);
    }
}
