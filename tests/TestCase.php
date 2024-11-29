<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use ReflectionException;
use ReflectionProperty;

abstract class TestCase extends BaseTestCase
{
    /**
     * @throws ReflectionException
     */
    public function setProtectedProperty(object $object, string $property, $value): void
    {
        $reflection = new ReflectionProperty($object, $property);
        $reflection->setValue($object, $value);
    }
}
