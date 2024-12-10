<?php

/** @var \App\Model\Dog $dog */
/** @var \App\Service\Router $router */

$title = "{$dog->getName()} ({$dog->getId()})";
$bodyClass = 'show';

ob_start(); ?>
    <h1><?= $dog->getName() ?></h1>
    <article>
        Breed : <?= $dog->getBreed();?>
        <br>
        Gender : <?= $dog->getGender();?>
    </article>

    <ul class="action-list">
        <li> <a href="<?= $router->generatePath('dog-index') ?>">Back to list</a></li>
        <li><a href="<?= $router->generatePath('dog-edit', ['id'=> $dog->getId()]) ?>">Edit</a></li>
    </ul>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
