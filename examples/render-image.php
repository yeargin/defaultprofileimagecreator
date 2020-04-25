<?php

require '../vendor/autoload.php';

use Yeargin\DefaultProfileImageCreator;

$image = new DefaultProfileImageCreator(128, 128);
$image->setInitials('SY');
$image->setColorFromString('Stephen Yeargin');
$image->create();

header('Content-type: image/png');
$image->toPng();
