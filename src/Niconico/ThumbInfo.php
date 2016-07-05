<?php
namespace Niconico;

/**
 * Class ThumbInfo
 * getthumbinfo
 *
 * @package Niconico
 */
class ThumbInfo
{
    use NicoClient;

    /**
     * @var string
     */
    public $endpoint = "http://ext.nicovideo.jp/api/getthumbinfo/";

    /**
     * @var \SimpleXMLElement
     */
    protected $data;

    /**
     * @param string $video_id sm9
     *
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function get($video_id)
    {
        $url = $this->endpoint . $video_id;

        $response = $this->request($url);

        $xml = simplexml_load_string($response);

        if ((string)$xml['status'] === 'fail') {
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
    public function toJson()
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * @return array
     */
    public function toArray()
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
     * @param string $property
     * @return string
     *
     * @throws \Exception
     */
    public function __get($property)
    {
        if (property_exists($this->data, $property)) {
            return (string)$this->data->{$property};
        }

        throw new \Exception(sprintf('Property [%s] does not exist.', $property));
    }
}
