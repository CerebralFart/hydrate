<?php

namespace CerebralFart\Hydrate\Test\Mocks;

class PrivateKVPair {
    private string $key;
    private string $value;

    public function getKey(): string {
        return $this->key;
    }

    public function getValue(): string {
        return $this->value;
    }
}
