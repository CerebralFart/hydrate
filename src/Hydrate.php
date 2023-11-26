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

        foreach ($data as $key => $value) {
            $instance->$key = $value;
        }

        return $instance;
    }
}
