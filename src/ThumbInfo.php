<?php

namespace Revolution\Niconico;

use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use SimpleXMLElement;

/**
 * マジックメソッドを使うことにより項目が追加・変更されても大丈夫なようにしている.
 *
 * Class ThumbInfo
 * getthumbinfo.
 */
class ThumbInfo
{
    use NicoClient;

    public string $endpoint = 'https://ext.nicovideo.jp/api/getthumbinfo/';

    protected SimpleXMLElement $data;

    /**
     * ThumbInfo constructor.
     *
     * @param  string|null  $video_id
     *
     * @throws GuzzleException
     */
    public function __construct(?string $video_id = null)
    {
        if (! is_null($video_id)) {
            $this->get($video_id);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws GuzzleException
     */
    public function get(string $video_id): static
    {
        $url = $this->endpoint.$video_id;

        $response = $this->request($url);

        $xml = simplexml_load_string($response);

        if ((string) $xml['status'] === 'fail') {
            $this->data = $xml->error;

            throw new InvalidArgumentException(sprintf('[%s]', $xml->error->description));
        } else {
            $this->data = $xml->thumb;
        }

        return $this;
    }

    public function toJson(): string
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }

    public function __toString(): string
    {
        return $this->toJson();
    }

    public function toArray(): array
    {
        return json_decode($this->toJson(), true);
    }

    public function toSimpleObject(): mixed
    {
        return json_decode($this->toJson());
    }

    /**
     * @throws InvalidArgumentException
     */
    public function __get(string $property): string
    {
        if (property_exists($this->data, $property)) {
            return (string) $this->data->{$property};
        }

        throw new InvalidArgumentException(sprintf('Property [%s] does not exist.', $property));
    }
}
