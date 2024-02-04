<?php

namespace CerebralFart\Hydrate;

use ReflectionClass;

class Hydrate {
    /**
     * @template T
     * @param $data
     * @param class-string<T> $type
     * @return T
     */
    public static function load($data, string $type): mixed {
        $refClass = new ReflectionClass($type);
        $instance = $refClass->newInstanceWithoutConstructor();

        $properties = $refClass->getProperties();
        foreach ($properties as $property) {
            $name = $property->getName();
            if (array_key_exists($name, $data)) {
                $property->setValue($instance, $data[$name]);
            }
        }

        return $instance;
    }
}
