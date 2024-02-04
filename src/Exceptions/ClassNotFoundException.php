<?php

namespace CerebralFart\Hydrate\Exceptions;

class ClassNotFoundException extends HydrationException {
    public function __construct(string $className) {
        parent::__construct('Class [%s] could not be found', $className);
    }
}
