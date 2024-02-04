<?php

namespace CerebralFart\Hydrate;

use CerebralFart\Hydrate\Exceptions\HydrationException;
use CerebralFart\Hydrate\Exceptions\UninitializedPropertyException;
use ReflectionClass;

class Hydrate {
    /**
     * @template T
     * @param $data
     * @param class-string<T> $type
     * @return T
     * @throws HydrationException
     */
    public static function load($data, string $type): mixed {
        $refClass = new ReflectionClass($type);
        $instance = $refClass->newInstanceWithoutConstructor();

        $properties = $refClass->getProperties();
        foreach ($properties as $property) {
            $name = $property->getName();
            if (array_key_exists($name, $data)) {
                $property->setValue($instance, $data[$name]);
            } else if (!$property->hasDefaultValue()) {
                throw new UninitializedPropertyException($type, $name);
            }
        }

        return $instance;
    }
}
