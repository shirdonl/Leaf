<?php

declare(strict_types=1);

namespace Leaf\Exception;

use Psr\Http\Client\NetworkExceptionInterface as PsrNetworkException;
use Psr\Http\Message\RequestInterface;

/**
 * @author Shirdon <https://www.shirdon.com/>
 */
class NetworkException extends ClientException implements PsrNetworkException
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
