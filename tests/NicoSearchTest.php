<?php

use Niconico\Search;
use Niconico\Search\Query;

class NicoSearchTest extends PHPUnit_Framework_TestCase
{
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
        $query->_sort = "-viewCounter";

        $res = $this->search->service('video')->search($query);
//        dd($res);

        $this->assertInternalType('object', $res);
        $this->assertEquals(200, $res->meta->status);
    }

    public function testSearchArray()
    {
        $query = new Query();

        $res = $this->search->service('video')->search($query, true);

        $this->assertInternalType('array', $res);
        $this->assertEquals(200, $res['meta']['status']);
    }


    public function testSearchLive()
    {
        $query = new Query();
        $query->q = 'ニコニコアニメスペシャル';
        $query->targets = 'tags';


        $res = $this->search->service('live')->search($query, true);
//        dd($res);

        $this->assertEquals(200, $res['meta']['status']);
    }
}
