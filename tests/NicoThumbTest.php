<?php

use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;

use Revolution\Niconico\ThumbInfo;

class NicoThumbTest extends TestCase
{
    /**
     * @var ThumbInfo
     */
    protected $thumb;

    public function setUp()
    {
        parent::setUp();

        $this->thumb = new ThumbInfo();
    }

    public function testNicoThumb()
    {
        $this->thumb->setClient(new Client())
                    ->setUserAgent('niconico')
                    ->get('sm9');

        $this->assertEquals('sm9', $this->thumb->video_id);
    }

    public function testNicoThumbJson()
    {
        $this->thumb->get('sm9');

        $this->assertContains('"video_id":"sm9"', $this->thumb->toJson());
        $this->assertContains('"video_id":"sm9"', (string) $this->thumb);
    }

    public function testNicoThumbConstruct()
    {
        $thumb = new ThumbInfo();

        $this->assertInstanceOf(ThumbInfo::class, $thumb);
        $this->assertFalse(isset($thumb->video_id));
    }

    public function testNicoThumbConstructWithParam()
    {
        $thumb = new ThumbInfo('sm9');

        $this->assertEquals('sm9', $thumb->video_id);
    }

    public function testNicoThumbArray()
    {
        $this->thumb->get('sm9');

        $this->assertEquals('sm9', $this->thumb->toArray()['video_id']);
    }

    public function testNicoThumbSimpleObject()
    {
        $this->thumb->get('sm9');

        $this->assertEquals('sm9', $this->thumb->toSimpleObject()->video_id);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testNicoThumbDelete()
    {
        $this->thumb->get('sm8');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testNicoThumbInvalidArgumentException()
    {
        $this->thumb->get('sm9');
        $this->thumb->test;
    }
}
