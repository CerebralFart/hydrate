<?php

namespace CerebralFart\Hydrate\Exceptions;

class UninstantiableClassException extends HydrationException {
    public function __construct(string $className) {
        parent::__construct('Class [%s] could not be instantiated, is it an internal class?', $className);
    }
}
