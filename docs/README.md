# Default Profile Image Creator

This allows you to create a PNG image using a user's initials on a circle, with the color set by a provided string (e.g. a User ID or their full name) to better differentiate between users. It as alternative to the typical "mystery man" avatar.

* Flexible implementation allows you to write to a cache or render inline
* Font color adjusts for readability on a particular background

### Requirements

- PHP 7.1 or later
- The [GD](https://www.php.net/manual/en/book.image.php) PHP extension.

### Sample Images

![1](1.png) ![2](2.png) ![3](3.png)

## Installation

```
composer require yeargin/defaultprofileimagecreator
```

## Basic Usage

Output the image directly into the buffer.

```php
use Yeargin\DefaultProfileImageCreator;

$image = new DefaultProfileImageCreator(128, 128);
$image->setInitials('SY');
$image->setColorFromString('Stephen Yeargin');
$image->create();

header('Content-type: image/png');
$image->toPng();
```

See the [`examples`](../examples) folder for additional sample code.
