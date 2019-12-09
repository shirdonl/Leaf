<?php

declare(strict_types=1);

namespace Leaf\Exception;

use Psr\Http\Client\RequestExceptionInterface as PsrRequestException;
use Psr\Http\Message\RequestInterface;

/**
 * @author Shirdon <https://www.shirdon.com/>
 */
class RequestException extends ClientException implements PsrRequestException
{
    /**
     * @var RequestInterface
     */
    private $request;

    public function __construct(RequestInterface $request, string $message = '', int $code = 0, \Throwable $previous = null)
    {
        $this->request = $request;
        parent::__construct($message, $code, $previous);
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
