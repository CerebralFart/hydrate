<?php

namespace CerebralFart\Hydrate\Exceptions;

class UninitializedPropertyException extends HydrationException {
    public function __construct(string $className, string $property) {
        parent::__construct("The property [%s::%s] has not been provided and has no default value", $className, $property);
    }
}
