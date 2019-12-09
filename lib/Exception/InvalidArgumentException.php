<?php

declare(strict_types=1);

namespace Leaf\Exception;

/**
 * Thrown when an invalid argument is provided.
 */
class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface
{
}
