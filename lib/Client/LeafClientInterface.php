<?php

declare(strict_types=1);

namespace Leaf\Client;

use Http\Client\HttpClient;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Shirdon <https://www.shirdon.com/>
 */
interface LeafClientInterface extends ClientInterface, HttpClient
{
    /**
     * {@inheritdoc}
     */
    public function sendRequest(RequestInterface $request, array $options = []): ResponseInterface;
}
