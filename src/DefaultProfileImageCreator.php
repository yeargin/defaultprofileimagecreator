<?php

namespace Yeargin;

/**
 * Default Profile Image Creator
 */
class DefaultProfileImageCreator
{
    const FONT_HEIGHT_RATIO = .35;

    protected $height;

    protected $width;

    protected $image;

    protected $color;

    protected $font;

    protected $fontBasePath;

    protected $fontHeight;

    protected $initials;

    function __construct(int $width=128, int $height=128)
    {
        $this->height = $height;
        $this->width = $width;
        $this->image = imagecreatetruecolor($width, $height);
        $this->color = imagecolorallocate($this->image, 250, 250, 250);
        $this->textColor = imagecolorallocate($this->image, 0, 0, 0);
        $this->fontHeight = round($this->height * self::FONT_HEIGHT_RATIO);
        $this->fontBasePath = dirname(__FILE__) . '/../resources/fonts/';
        $this->font = $this->fontBasePath . 'Roboto/Roboto-Bold.ttf';
        $this->initials = '??';
    }

    public function setFontBasePath(string $string): self
    {
        $this->fontBasePath = $string;
        return $this;
    }

    public function getFontBasePath(): string
    {
        return $this->fontBasePath;
    }

    public function setFont(string $string): self
    {
        $this->font = $string;
        return $this;
    }
    public function getFont(): string
    {
        return $this->font;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setColorFromString(string $string): self
    {
        // Sets the background color from the string value
        $code = dechex(crc32($string));
        $code = substr($code, 0, 6);
        list($r, $g, $b) = sscanf($code, "%02x%02x%02x");
        $this->color = imagecolorallocate($this->image, $r, $g, $b);

        // Determine if the text color should be light instead of dark
        $hsl = (max($r, $g, $b) + min($r, $g, $b)) / 510.0;
        if ($hsl < .4) {
            $this->textColor = imagecolorallocate($this->image, 255, 255, 255);
        }

        return $this;
    }

    public function setColor(int $r, int $g, int $b): self
    {
        $this->color = imagecolorallocate($this->image, $r, $g, $b);
        return $this;
    }

    public function setTextColor(int $r, int $g, int $b): self
    {
        $this->textColor = imagecolorallocate($this->image, $r, $g, $b);
        return $this;
    }

    public function setInitials(?string $string): self
    {
        $this->initials = $string;
        return $this;
    }

    public function create(): self
    {
        imagesavealpha($this->image, true);

        // Fill image with transparent color
        imagefill($this->image, 0, 0, imagecolorallocatealpha($this->image, 0, 0, 0, 127));

        // Draw a circle
        imagefilledellipse($this->image, $this->height/2, $this->width/2, $this->height, $this->width, $this->color);

        // Calculate the bounding box of the font
        $dimensions = imagettfbbox($this->fontHeight, 0, $this->font, $this->initials);
        $x = ($this->width - abs($dimensions[2]))/2;
        $y = ($this->height + abs($dimensions[5]))/2;

        // Put the initials on top of it
        imagettftext($this->image, $this->fontHeight, 0, $x, $y, $this->textColor, $this->font, $this->initials);

        return $this;
    }

    public function toPng($dest=null)
    {
        imagepng($this->image, $dest);
        imagedestroy($this->image);
    }

    public function __destruct()
    {
        if (is_resource($this->image)) {
            imagedestroy($this->image);
        }
    }
}
