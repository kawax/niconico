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
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client|ClientInterface
     */
    public function getClient()
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
    public function request($url, $method = 'GET')
    {
        $response = $this->getClient()->request($method, $url, [
            'headers' => [
                'User-Agent' => $this->userAgent,
            ],
        ]);

        return (string) $response->getBody();
    }

    /**
     * @param string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }
}
