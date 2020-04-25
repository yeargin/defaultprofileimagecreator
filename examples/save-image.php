<?php

require '../vendor/autoload.php';

use Yeargin\DefaultProfileImageCreator;

$image = new DefaultProfileImageCreator(128, 128);
$image->setInitials('JD');
$image->setColorFromString('John Doe');
$image->create();

$image->toPng('/tmp/defaultprofileimagecreator-test.png');

print 'Open: <tt>/tmp/defaultprofileimagecreator-test.png</tt>';
