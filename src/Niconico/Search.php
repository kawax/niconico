<?php

namespace Niconico;

use Niconico\Search\Query;

/**
 * niconico コンテンツ検索API
 * @see http://search.nicovideo.jp/docs/api/search.html
 */
class Search
{
    use NicoClient;

    /**
     * @var string
     */
    public $endpoint = 'http://api.search.nicovideo.jp/api/v2/:service/contents/search';

    /**
     * @var string
     */
    protected $service = 'video';

    /**
     * @param Query $query
     * @param bool  $assoc trueなら配列。falseならオブジェクト。
     *
     * @return mixed
     */
    public function search(Query $query, $assoc = false)
    {
        $url = $this->endpoint().'?'.$query->build();

        $res = json_decode($this->request($url), $assoc);

        return $res;
    }

    /**
     * @param string $service
     *
     * @return $this
     */
    public function service($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return string
     */
    protected function endpoint()
    {
        return str_replace(':service', $this->service, $this->endpoint);
    }
}
