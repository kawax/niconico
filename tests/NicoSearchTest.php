<?php

use PHPUnit\Framework\TestCase;

use Revolution\Niconico\Search;
use Revolution\Niconico\Search\Query;

class NicoSearchTest extends TestCase
{
    /**
     * @var Search
     */
    protected $search;

    public function setUp()
    {
        parent::setUp();

        $this->search = new Search();
    }

    public function testSearch()
    {
        $query = new Query();
        $query->q = '初音ミク';
        $query->targets = 'title,tags';
        $query->_sort = '-viewCounter';
        $query->filters(['filters[mylistCounter][gte]=10000', 'filters[commentCounter][gte]=100000']);

        $res = $this->search->service('video')->search($query);

        $this->assertIsObject($res);
        $this->assertEquals(200, $res->meta->status);
        $this->assertTrue(isset($query->q));
        $this->assertNull($query->test);
        $this->assertEquals('初音ミク', $query->q);

        unset($query->test);
    }

    public function testSearchArray()
    {
        $query = new Query();

        $res = $this->search->service('video')->search($query, true);

        $this->assertIsArray($res);
        $this->assertEquals(200, $res['meta']['status']);
    }

    public function testSearchLive()
    {
        $query = new Query();
        $query->q = 'ニコニコアニメスペシャル';
        $query->targets = 'tags';

        $res = $this->search->service('live')->search($query, true);

        $this->assertEquals(200, $res['meta']['status']);
    }

    public function testSearchChannel()
    {
        $query = new Query();
        $query->q = 'アニメ';
        $query->targets = 'tags';
        $query->fields = 'contentId,title,tags';
        $query->filters(['filters[startTime][lt]='.rawurlencode('2016-01-01T00:00:00+09:00')]);

        $res = $this->search->service('channel')->search($query);

        $this->assertEquals(200, $res->meta->status);
    }

    public function testSearchIllust()
    {
        $query = new Query();
        $query->q = '初音ミク';
        $query->targets = 'tags';
        $query->fields = 'contentId,title,description,tags,thumbnailUrl,viewCounter,mylistCounter,commentCounter,startTime';
        $query->_sort = '-startTime';
        $query->_limit = '10';

        $res = $this->search->service('illust')->search($query);

        $this->assertEquals(200, $res->meta->status);
    }

    public function testQueryBuild()
    {
        $query = (new Query())->build();

        $this->assertEquals(
            'q=%E5%88%9D%E9%9F%B3%E3%83%9F%E3%82%AF&targets=title%2Ctags&fields=contentId%2Ctitle%2Cdescription%2Ctags%2CstartTime%2CviewCounter%2CthumbnailUrl&_sort=-startTime&_offset=0&_limit=10&_context=niconico',
            $query
        );
    }

    public function testQueryConstruct()
    {
        $query = (new Query([
            'q'       => '初音ミク',
            'targets' => 'title,tags',
        ]))->build();

        $this->assertEquals(
            'q=%E5%88%9D%E9%9F%B3%E3%83%9F%E3%82%AF&targets=title%2Ctags',
            $query
        );
    }

    public function testQueryCreate()
    {
        $query = Query::create([
            'q'       => '初音ミク',
            'targets' => 'title,tags',
        ])->build();

        $this->assertEquals(
            'q=%E5%88%9D%E9%9F%B3%E3%83%9F%E3%82%AF&targets=title%2Ctags',
            $query
        );
    }
}
