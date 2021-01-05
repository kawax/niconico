<?php

namespace Revolution\Niconico;

use GuzzleHttp\Exception\GuzzleException;
use Revolution\Niconico\Search\Query;

/**
 * niconico コンテンツ検索API.
 *
 * @see http://site.nicovideo.jp/search-api-docs/search.html
 */
class Search
{
    use NicoClient;

    /**
     * @var string
     */
    public $endpoint = 'https://api.search.nicovideo.jp/api/v2/:service/contents/search';

    /**
     * @var string
     */
    protected $service = 'video';

    /**
     * @param  Query  $query
     * @param  bool  $assoc  trueなら配列。falseならオブジェクト。
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function search(Query $query, bool $assoc = false)
    {
        $url = $this->endpoint().'?'.$query->build();

        return json_decode($this->request($url), $assoc);
    }

    /**
     * @param  string  $service
     *
     * @return $this
     */
    public function service(string $service): Search
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return string
     */
    protected function endpoint(): string
    {
        return str_replace(':service', $this->service, $this->endpoint);
    }
}
