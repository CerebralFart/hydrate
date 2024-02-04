<?php

namespace CerebralFart\Hydrate\Exceptions;

use Exception;

abstract class HydrationException extends Exception {
    public function __construct(string $template, ...$args) {
        parent::__construct(sprintf($template, ...$args));
    }
}
