<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Model\Dog;
use App\Service\Router;
use App\Service\Templating;

class DogController
{
    public function indexAction(Templating $templating, ROuter $router): ?string
    {
        $dogs = Dog::findAll();
        $html = $templating->render('dog/index.html.php', [
            'dogs' => $dogs,
            'router' => $router,
        ]);

        return $html;
    }

    public function createAction(?array $requestDog, Templating $templating, Router $router): ?string
    {
        if ($requestDog) {
            $dog = Dog::fromArray($requestDog);
            // @todo missing validation
            $dog->save();

            $path = $router->generatePath('dog-index');
            $router->redirect($path);
            return null;
        } else {
            $dog = new Dog();
        }

        $html = $templating->render('dog/create.html.php', [
            'dog' => $dog,
            'router' => $router,
        ]);
        return $html;
    }

    public function editAction(int $dogId, ?array $requestDog, Templating $templating, Router $router): ?string
    {
        $dog = Dog::find($dogId);
        if (!$dog) {
            throw new NotFoundException("Missing dog with id $dogId");
        }

        if($requestDog) {
            $dog->fill($requestDog);
            // @todo missing validation
            $dog->save();

            $path = $router->generatePath('dog-index');
            $router->redirect($path);
            return null;
        }

        $html = $templating->render('dog/edit.html.php', [
            'dog' => $dog,
            'router' => $router,
        ]);

        return $html;
    }

    public function showAction(int $dogId, Templating $templating, Router $router): ?string
    {
        $dog = Dog::find($dogId);
        if (!$dog) {
            throw new NotFoundException("Missing dog with id $dogId");
        }

        $html = $templating->render('dog/show.html.php', [
            'dog' => $dog,
            'router' => $router,
        ]);

        return $html;
    }

    public function deleteAction(int $dogId, Router $router): ?string
    {
        $dog = Dog::find($dogId);
        if (!$dog) {
            throw new NotFoundException("Missing dog with id $dogId");
        }

        $dog->delete();

        $path = $router->generatePath('dog-index');
        $router->redirect($path);
        return null;
    }
}