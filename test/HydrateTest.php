<?php

namespace CerebralFart\Hydrate\Test;

use CerebralFart\Hydrate\Hydrate;
use CerebralFart\Hydrate\Test\Mocks\KVPair;
use PHPUnit\Framework\TestCase;

class HydrateTest extends TestCase {
    public function test_public_props() {
        $data = [
            'key' => 'hydrate',
            'value' => 'awesome',
        ];
        $struct = Hydrate::load($data, KVPair::class);

        $this->assertInstanceOf(KVPair::class, $struct);
        $this->assertEquals('hydrate', $struct->key);
        $this->assertEquals('awesome', $struct->value);
    }
}
