<?php
declare(strict_types=1);

namespace Tests\Unit\Features\Products\Application\Dto;

use App\Features\Product\Application\Dto\ProductUpdateDto;
use Tests\TestCase;

class ProductUpdateDtoTest extends TestCase
{
    private ProductUpdateDto $sut;

    protected function setUp(): void {
        parent::setUp();

        $this->sut = new ProductUpdateDto();
    }

    public function testDescriptionField()
    {
        $this->sut->description = 'Test Description';

        $this->assertEquals('Test Description', $this->sut->description);
        $this->assertIsString($this->sut->description);
    }

    public function testDetailsField()
    {
        $this->sut->details = 'Test Details';

        $this->assertEquals('Test Details', $this->sut->details);
        $this->assertIsString($this->sut->details);
    }

    public function testValueField()
    {
        $this->sut->value = 10.50;
        $this->assertEquals(10.50, $this->sut->value);
        $this->assertIsNumeric($this->sut->value);
    }

    public function testQuantityField()
    {
        $this->sut->quantity = 40;

        $this->assertEquals(40, $this->sut->quantity);
        $this->assertIsInt($this->sut->quantity);
    }

    public function testActiveField()
    {
        $this->sut->active = false;

        $this->assertFalse($this->sut->active);
    }
}