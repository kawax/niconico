<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Revolution\Niconico\ThumbInfo;

class NicoThumbTest extends TestCase
{
    protected ThumbInfo $thumb;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thumb = new ThumbInfo;
    }

    public function test_nico_thumb()
    {
        $this->thumb->setClient(new Client)
            ->setUserAgent('niconico')
            ->get('sm9');

        $this->assertEquals('sm9', $this->thumb->video_id);
    }

    public function test_nico_thumb_json()
    {
        $this->thumb->get('sm9');

        $this->assertStringContainsString('"video_id":"sm9"', $this->thumb->toJson());
        $this->assertStringContainsString('"video_id":"sm9"', (string) $this->thumb);
    }

    public function test_nico_thumb_construct()
    {
        $thumb = new ThumbInfo;

        $this->assertInstanceOf(ThumbInfo::class, $thumb);
        $this->assertFalse(isset($thumb->video_id));
    }

    public function test_nico_thumb_construct_with_param()
    {
        $thumb = new ThumbInfo('sm9');

        $this->assertEquals('sm9', $thumb->video_id);
    }

    public function test_nico_thumb_array()
    {
        $this->thumb->get('sm9');

        $this->assertEquals('sm9', $this->thumb->toArray()['video_id']);
    }

    public function test_nico_thumb_simple_object()
    {
        $this->thumb->get('sm9');

        $this->assertEquals('sm9', $this->thumb->toSimpleObject()->video_id);
    }

    public function test_nico_thumb_delete()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->thumb->get('sm8');
    }

    public function test_nico_thumb_invalid_argument_exception()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->thumb->get('sm9');
        $this->thumb->test;
    }
}
