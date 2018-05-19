<?php

namespace Niconico;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

trait NicoClient
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $userAgent = 'niconico';

    /**
     * @param ClientInterface $client
     *
     * @return $this
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Client|ClientInterface
     */
    public function getClient(): ClientInterface
    {
        if (is_null($this->client)) {
            $this->client = new Client();
        }

        return $this->client;
    }

    /**
     * @param string $url
     * @param string $method
     *
     * @return string
     */
    public function request(string $url, string $method = 'GET'): string
    {
        $response = $this->getClient()->request($method, $url, [
            'headers' => [
                'User-Agent' => $this->userAgent,
            ],
        ]);

        return (string)$response->getBody();
    }

    /**
     * @param string $userAgent
     *
     * @return $this
     */
    public function setUserAgent(string $userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }
}
