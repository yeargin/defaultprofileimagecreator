<?php

use PHPUnit\Framework\TestCase;
use Yeargin\DefaultProfileImageCreator;

final class DefaultProfileImageCreatorTest extends TestCase
{
    protected $creator;

    public function setup(): void
    {
        $this->creator = new DefaultProfileImageCreator();
    }

    public function testFontPaths()
    {
        $this->assertTrue(file_exists($this->creator->getFontBasePath()));
        $this->assertTrue(file_exists($this->creator->getFont()));
    }

    public function testCreateImage()
    {
        $this->creator->setColorFromString('Stephen Yeargin');
        $this->creator->setInitials('SY');
        $image = $this->creator->create();

        $this->assertEquals('gd', get_resource_type($image->getImage()));
    }

    public function testToPng()
    {
        $this->expectOutputRegex('/png/i');
        $filename = $this->creator->toPng();
    }
}
