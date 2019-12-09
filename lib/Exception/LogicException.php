<?php

declare(strict_types=1);

namespace Leaf\Exception;

/**
 * Thrown whenever a required call-flow is not respected.
 */
class LogicException extends \LogicException implements ExceptionInterface
{
}
