<?php

declare(strict_types=1);

namespace Leaf\Exception;

use Http\Client\Exception as HTTPlugException;

/**
 * @author Shirdon <https://www.shirdon.com/>
 */
class ClientException extends \RuntimeException implements ExceptionInterface, HTTPlugException
{
}
