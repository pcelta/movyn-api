<?php

namespace App\Entity;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class UidFactory
{
    private static array $mapping = [
        Currency::class => [
            'prefix' => Currency::UID_PREFIX
        ]
    ];

    public static function create(string $type): string
    {
        if (!array_key_exists($type, self::$mapping)) {
            throw new InvalidArgumentException('Invalid Type given');
        }

        $prefix = self::$mapping[$type]['prefix'];
        $uuid = Uuid::uuid4();


        return sprintf('%s-%s', $prefix, $uuid);
    }
}
