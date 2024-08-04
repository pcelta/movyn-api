<?php

namespace AppTest;

use App\Entity\Currency;
use App\Entity\UidFactory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UidFactoryTest extends TestCase
{
    public function testCreateShouldThrowAnInvalidArgumentExceptionWhenInvalidTypeGiven()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid Type given');

        $invalidType = 'anything';
        UidFactory::create($invalidType);
    }

    public function testCreateShouldSuccessfulyReturnUid()
    {
        $result = UidFactory::create(Currency::class);

        $patternTest = '/^cur-/';
        $this->assertMatchesRegularExpression($patternTest, $result);
        $this->assertEquals(40, strlen($result));
    }
}
