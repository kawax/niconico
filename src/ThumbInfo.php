<?php

namespace Revolution\Niconico;

use GuzzleHttp\Exception\GuzzleException;

/**
 * マジックメソッドを使うことにより項目が追加・変更されても大丈夫なようにしている
 *
 * Class ThumbInfo
 * getthumbinfo.
 */
class ThumbInfo
{
    use NicoClient;

    /**
     * @var string
     */
    public $endpoint = 'https://ext.nicovideo.jp/api/getthumbinfo/';

    /**
     * @var \SimpleXMLElement
     */
    protected $data;

    /**
     * ThumbInfo constructor.
     *
     * @param  string|null  $video_id
     */
    public function __construct(?string $video_id = null)
    {
        if (! is_null($video_id)) {
            $this->get($video_id);
        }
    }

    /**
     * @param  string  $video_id  sm9
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function get(string $video_id): ThumbInfo
    {
        $url = $this->endpoint.$video_id;

        $response = $this->request($url);

        $xml = simplexml_load_string($response);

        if ((string) $xml['status'] === 'fail') {
            $this->data = $xml->error;

            throw new \InvalidArgumentException(sprintf('[%s]', $xml->error->description));
        } else {
            $this->data = $xml->thumb;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return json_decode($this->toJson(), true);
    }

    /**
     * @return mixed
     */
    public function toSimpleObject()
    {
        return json_decode($this->toJson());
    }

    /**
     * @param  string  $property
     *
     * @return string
     * @throws \InvalidArgumentException
     *
     */
    public function __get(string $property): string
    {
        if (property_exists($this->data, $property)) {
            return (string) $this->data->{$property};
        }

        throw new \InvalidArgumentException(sprintf('Property [%s] does not exist.', $property));
    }
}
