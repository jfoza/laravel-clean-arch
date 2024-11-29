<?php
declare(strict_types=1);

namespace App\Libraries\LaravelInjectable\Src;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;
use ReflectionProperty;

class InjectionServiceProvider extends ServiceProvider
{
    private static array $cache = [];

    public function boot(): void
    {
        $this->app->resolving(function ($object) {
            if (is_object($object)) {
                $this->injectDependencies($object);
            }
        });
    }

    /**
     * @throws BindingResolutionException
     */
    private function injectDependencies(object $object): void
    {
        $className = get_class($object);

        if (!isset(self::$cache[$className])) {
            self::$cache[$className] = new ReflectionClass($object)->getProperties();
        }

        foreach (self::$cache[$className] as $property) {
            $this->injectProperty($object, $property);
        }
    }

    /**
     * @throws BindingResolutionException
     */
    private function injectProperty(object $object, ReflectionProperty $property): void
    {
        $attributes = $property->getAttributes(Inject::class);

        if (!empty($attributes)) {
            $attribute = $attributes[0]->newInstance();
            $instance = app()->make($attribute->class);
            $property->setValue($object, $instance);
        }
    }
}
