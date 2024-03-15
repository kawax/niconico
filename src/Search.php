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

    public string $endpoint = 'https://snapshot.search.nicovideo.jp/api/v2/snapshot/video/contents/search';

    /**
     * @param  Query  $query
     * @param  bool  $assoc trueなら配列。falseならオブジェクト。
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function search(Query $query, bool $assoc = false): mixed
    {
        $url = $this->endpoint().'?'.$query->build();

        return json_decode($this->request($url), $assoc);
    }

    protected function endpoint(): string
    {
        return $this->endpoint;
    }
}
