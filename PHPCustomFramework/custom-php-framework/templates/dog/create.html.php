<?php

/** @var \App\Model\Dog $dog */
/** @var \App\Service\Router $router */

$title = 'Add Dog';
$bodyClass = "edit";

ob_start(); ?>
    <h1>Add Dog</h1>
    <form action="<?= $router->generatePath('dog-create') ?>" method="post" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
        <input type="hidden" name="action" value="dog-create">
    </form>

    <a href="<?= $router->generatePath('dog-index') ?>">Back to list</a>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
