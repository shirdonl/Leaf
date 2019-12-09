<?php

declare(strict_types=1);

namespace Leaf\Message;

/**
 * Convert between Leaf style:
 * array(
 *   'foo: bar',
 *   'baz: biz',
 * ).
 *
 * and PSR style:
 * array(
 *   'foo' => 'bar'
 *   'baz' => ['biz', 'buz'],
 * )
 *
 * @author Shirdon <https://www.shirdon.com/>
 */
class HeaderConverter
{
    /**
     * Convert from PSR style headers to Leaf style.
     */
    public static function toLeafHeaders(array $headers): array
    {
        $Leaf = [];

        foreach ($headers as $key => $values) {
            if (!\is_array($values)) {
                $Leaf[] = sprintf('%s: %s', $key, $values);
            } else {
                foreach ($values as $value) {
                    $Leaf[] = sprintf('%s: %s', $key, $value);
                }
            }
        }

        return $Leaf;
    }

    /**
     * Convert from Leaf style headers to PSR style.
     */
    public static function toPsrHeaders(array $headers): array
    {
        $psr = [];
        foreach ($headers as $header) {
            list($key, $value) = explode(':', $header, 2);
            $psr[trim($key)][] = trim($value);
        }

        return $psr;
    }
}
