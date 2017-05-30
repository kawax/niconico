<?php

use PHPUnit\Framework\TestCase;

use Niconico\ThumbInfo;

class NicoThumbTest extends TestCase
{
    protected $thumb;

    public function setUp()
    {
        parent::setUp();

        $this->thumb = new ThumbInfo();
    }

    public function testNicoThumb()
    {
        $this->thumb->get('sm9');

        $this->assertEquals('sm9', $this->thumb->video_id);
    }

    public function testNicoThumbJson()
    {
        $this->thumb->get('sm9');

        $this->assertContains('"video_id":"sm9"', $this->thumb->toJson());
        $this->assertContains('"video_id":"sm9"', (string) $this->thumb);
    }

    public function testNicoThumbArray()
    {
        $this->thumb->get('sm9');

//        dd($this->thumb->toArray());

        $this->assertEquals('sm9', $this->thumb->toArray()['video_id']);
    }

    public function testNicoThumbSimpleObject()
    {
        $this->thumb->get('sm9');

        $this->assertEquals('sm9', $this->thumb->toSimpleObject()->video_id);
    }

    /**
     * @expectedException Exception
     */
    public function testNicoThumbDelete()
    {
        $this->thumb->get('sm8');
    }
}
