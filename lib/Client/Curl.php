<?php

declare(strict_types=1);

namespace Leaf\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Shirdon <https://www.shirdon.com/>
 */
class Curl extends AbstractCurl implements LeafClientInterface
{
    public function sendRequest(RequestInterface $request, array $options = []): ResponseInterface
    {
        $options = $this->validateOptions($options);
        $curl = $this->createHandle();
        $responseBuilder = $this->prepare($curl, $request, $options);

        $curlInfo = null;
        try {
            curl_exec($curl);
            $this->parseError($request, curl_errno($curl), $curl);

            if ($options->get('expose_curl_info')) {
                $curlInfo = curl_getinfo($curl);
            }
        } finally {
            $this->releaseHandle($curl);
        }

        $response = $responseBuilder->getResponse();
        if (null !== $curlInfo && $value = json_encode($curlInfo)) {
            $response = $response->withHeader('__curl_info', $value);
        }

        return $response;
    }
}
