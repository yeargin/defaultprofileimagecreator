<?php

require '../vendor/autoload.php';

use Yeargin\DefaultProfileImageCreator;

if (isset($_GET['seed']) && $_GET['seed']) {
    $image = new DefaultProfileImageCreator(64, 64);
    $image->setInitials(substr($_GET['seed'], -2, 2));
    $image->setColorFromString($_GET['seed']);
    $image->create();
    header('Content-type: image/png');
    $image->toPng();
    exit;
}

?>

<?php foreach (range(0, 2500) as $i): ?>
<div style="float:left;padding:0.1em;">
    <img src="?seed=<?php echo $i; ?>-<?php echo time(); ?>" alt="Image Test">
</div>
<?php endforeach ?>
