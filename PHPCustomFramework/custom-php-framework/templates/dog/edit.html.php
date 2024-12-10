<?php

/** @var \App\Model\Dog $dog */
/** @var \App\Service\Router $router */

$title = "Edit Dog {$dog->getName()} ({$dog->getId()})";
$bodyClass = "edit";

ob_start(); ?>
    <h1><?= $title ?></h1>
    <form action="<?= $router->generatePath('dog-edit') ?>" method="post" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
        <input type="hidden" name="action" value="dog-edit">
        <input type="hidden" name="id" value="<?= $dog->getId() ?>">
    </form>

    <ul class="action-list">
        <li>
            <a href="<?= $router->generatePath('dog-index') ?>">Back to list</a></li>
        <li>
            <form action="<?= $router->generatePath('dog-delete') ?>" method="post">
                <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                <input type="hidden" name="action" value="dog-delete">
                <input type="hidden" name="id" value="<?= $dog->getId() ?>">
            </form>
        </li>
    </ul>

<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
