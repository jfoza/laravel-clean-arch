<?php
declare(strict_types=1);

namespace Tests\Unit\Features\Products\Domain\Entities;

use App\Common\Domain\ValueObjects\Date;
use App\Common\Domain\ValueObjects\UniqueEntityId;
use App\Features\Product\Application\Factory\ProductFactory;
use App\Features\Product\Domain\Entities\Product;
use App\Features\Product\Domain\Props\ProductProps;
use App\Features\Product\Domain\ValueObjects\UniqueProductDescription;
use App\Libraries\Uuid\Uuid;
use Tests\TestCase;

class ProductTest extends TestCase
{
    private Product $sut;
    private ProductProps $props;

    protected function setUp(): void {
        parent::setUp();

        $this->props = ProductFactory::productProps();
        $this->props->description = 'Test Description';
        $this->props->details = 'Test Details';
        $this->props->uniqueName = UniqueProductDescription::assign('test-description');
        $this->props->value = 10.50;
        $this->props->quantity = 40;
        $this->props->active = true;

        $this->sut = Product::create($this->props);
    }

    public function testConstructMethod(): void
    {
        $uuid = Uuid::v4();
        $product = Product::create($this->props, UniqueEntityId::create($uuid));

        $this->assertEquals($this->props->description, $product->description);
        $this->assertEquals($this->props->details, $product->details);
        $this->assertEquals($this->props->uniqueName->toString(), $product->uniqueName);
        $this->assertInstanceOf(UniqueProductDescription::class, $this->props->uniqueName);
        $this->assertEquals($this->props->value, $product->value);
        $this->assertEquals($this->props->quantity, $product->quantity);
        $this->assertEquals($this->props->active, $product->active);
        $this->assertEquals($this->props->createdAt->toValue(), $product->createdAt);
        $this->assertInstanceOf(Date::class, $this->props->createdAt);
        $this->assertEquals($uuid, $product->uuid);

        $propsWithoutCreatedAt = clone $this->props;
        $propsWithoutCreatedAt->createdAt = null;

        $productWithoutCreatedAt = Product::create($propsWithoutCreatedAt);

        $this->assertNotNull($productWithoutCreatedAt->createdAt);
    }

    public function testGetterDescriptionField()
    {
        $this->assertEquals($this->sut->description, $this->props->description);
        $this->assertIsString($this->sut->description);
    }

    public function testGetterDetailsField()
    {
        $this->assertEquals($this->sut->details, $this->props->details);
        $this->assertIsString($this->sut->details);
    }

    public function testGetterUniqueNameField()
    {
        $this->assertEquals($this->sut->uniqueName, $this->props->uniqueName->toString());
        $this->assertIsString($this->sut->uniqueName);
    }

    public function testGetterValueField()
    {
        $this->assertEquals($this->sut->value, $this->props->value);
        $this->assertIsNumeric($this->sut->value);
    }

    public function testGetterQuantityField()
    {
        $this->assertEquals($this->sut->quantity, $this->props->quantity);
        $this->assertIsInt($this->sut->quantity);
    }

    public function testGetterActiveField()
    {
        $this->assertEquals($this->sut->active, $this->props->active);
        $this->assertIsBool($this->sut->active);
    }

    public function testGetterCreatedAtField()
    {
        $this->assertEquals($this->sut->createdAt, $this->props->createdAt->toValue());
        $this->assertIsString($this->sut->createdAt);
    }

    public function testSetterDescriptionField()
    {
        $this->sut->description = 'New description';
        $this->assertEquals('New description', $this->sut->description);
        $this->assertIsString($this->sut->description);
    }

    public function testSetterDetailsField()
    {
        $this->sut->details = 'New details';
        $this->assertEquals('New details', $this->sut->details);
        $this->assertIsString($this->sut->details);
    }

    public function testSetterValueField()
    {
        $this->sut->value = 68.99;
        $this->assertEquals(68.99, $this->sut->value);
        $this->assertIsNumeric($this->sut->value);
    }

    public function testSetterQuantityField()
    {
        $this->sut->quantity = 10;
        $this->assertEquals(10, $this->sut->quantity);
        $this->assertIsInt($this->sut->quantity);
    }

    public function testSetterActiveField()
    {
        $this->sut->active = false;
        $this->assertFalse($this->sut->active);
    }

    public function testCreateMethodShouldReturnProductInstance()
    {
        $product = $this->sut::create($this->props);

        $this->assertInstanceOf(Product::class, $product);
    }
}
