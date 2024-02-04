<?php

namespace CerebralFart\Hydrate;

use CerebralFart\Hydrate\Exceptions\ClassNotFoundException;
use CerebralFart\Hydrate\Exceptions\HydrationException;
use CerebralFart\Hydrate\Exceptions\UninitializedPropertyException;
use CerebralFart\Hydrate\Exceptions\UninstantiableClassException;
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
        if (!class_exists($type)) {
            throw new ClassNotFoundException($type);
        }

        $refClass = new ReflectionClass($type);

        if ($refClass->isInternal() && $refClass->isFinal()) {
            throw new UninstantiableClassException($type);
        }

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
