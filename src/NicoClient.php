<?php

namespace Revolution\Niconico;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

trait NicoClient
{
    protected ?ClientInterface $client = null;

    protected string $userAgent = 'niconico';

    public function setClient(ClientInterface $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getClient(): ClientInterface
    {
        if (is_null($this->client)) {
            $this->client = new Client();
        }

        return $this->client;
    }

    /**
     * @throws GuzzleException
     */
    public function request(string $url, string $method = 'GET'): string
    {
        $response = $this->getClient()->request($method, $url, [
            'headers' => [
                'User-Agent' => $this->userAgent,
            ],
        ]);

        return (string) $response->getBody();
    }

    public function setUserAgent(string $userAgent): static
    {
        $this->userAgent = $userAgent;

        return $this;
    }
}
