<?php

namespace Revolution\Niconico;

use GuzzleHttp\Exception\GuzzleException;
use Revolution\Niconico\Search\Query;

/**
 * niconico スナップショット検索API v2.
 *
 * @see https://site.nicovideo.jp/search-api-docs/snapshot
 */
class Search
{
    use NicoClient;

    /**
     * @var string
     */
    public $endpoint = 'https://api.search.nicovideo.jp/api/v2/snapshot/video/contents/search';

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
     * @return string
     */
    protected function endpoint(): string
    {
        return $this->endpoint;
    }
}
