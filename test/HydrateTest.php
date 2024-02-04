<?php

namespace CerebralFart\Hydrate\Test;

use CerebralFart\Hydrate\Exceptions\UninitializedPropertyException;
use CerebralFart\Hydrate\Hydrate;
use CerebralFart\Hydrate\Test\Mocks\KVPair;
use CerebralFart\Hydrate\Test\Mocks\PrivateKVPair;
use Exception;
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

    public function test_private_props() {
        $data = [
            'key' => 'hydrate',
            'value' => 'awesome',
        ];
        $struct = Hydrate::load($data, PrivateKVPair::class);

        $this->assertInstanceOf(PrivateKVPair::class, $struct);
        $this->assertEquals('hydrate', $struct->getKey());
        $this->assertEquals('awesome', $struct->getValue());
    }

    public function test_overcomplete_properties_are_ignored() {
        $data = [
            'key' => 'hydrate',
            'value' => 'awesome',
            'meta' => 'does not exist',
        ];
        $struct = Hydrate::load($data, KVPair::class);

        $this->assertInstanceOf(KVPair::class, $struct);
        $this->assertEquals('hydrate', $struct->key);
        $this->assertEquals('awesome', $struct->value);
        $this->assertObjectNotHasProperty('meta', $struct);
    }

    public function test_throws_exception_on_missing_property() {
        $this->assertThrows(
            fn() => Hydrate::load([
                'key' => 'hydrate',
            ], KVPair::class),
            UninitializedPropertyException::class,
            'KVPair::value',
        );
    }

    /**
     * @param callable $function
     * @param class-string<Exception> $exceptionType
     * @param string $expectedMessage
     * @return void
     */
    private function assertThrows(callable $function, string $exceptionType = Exception::class, string $expectedMessage = ''): void {
        try {
            $function();
            $this->fail(sprintf("Expected function to throw a %s exception", $exceptionType));
        } catch (Exception$exception) {
            $this->assertInstanceOf($exceptionType, $exception);
            $this->assertStringContainsString($expectedMessage, $exception->getMessage());
        }
    }
}
