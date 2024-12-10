<?php
namespace App\Model;

use App\Service\Config;

class Dog
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $breed = null;
    private ?string $gender = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Dog
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Dog
    {
        $this->name = $name;

        return $this;
    }

    public function getBreed(): ?string
    {
        return $this->breed;
    }

    public function setBreed(?string $breed): Dog
    {
        $this->breed = $breed;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): Dog
    {
        $this->gender = $gender;

        return $this;
    }

    public static function fromArray($array): Dog
    {
        $dog = new self();
        $dog->fill($array);

        return $dog;
    }

    public function fill($array): Dog
    {
        if (isset($array['id']) && !$this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['name']) && !$this->getName()) {
            $this->setName($array['name']);
        }
        if (isset($array['breed']) && !$this->getBreed()) {
            $this->setBreed($array['breed']);
        }
        if (isset($array['gender']) && !$this->getGender()) {
            $this->setGender($array['gender']);
        }
        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM dog';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $dogs = [];
        $dogsArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($dogsArray as $dogArray) {
            $dogs[] = self::fromArray($dogArray);
        }

        return $dogs;
    }

    public static function find($id): ?Dog
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM dog WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $dogArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (!$dogArray) {
            return null;
        }
        $dog = Dog::fromArray($dogArray);

        return $dog;
    }


    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if(!$this->getId()) {
            $sql = "INSERT INTO dog (name, breed, gender) VALUES (:name, :breed, :gender)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'name' => $this->getName(),
                'breed' => $this->getBreed(),
                'gender' => $this->getGender(),
            ]);

            $this->setId($pdo->lastInsertId());
        } else {
            $sql = "UPDATE dog SET name = :name, breed = :breed, gender = :gender WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':name' => $this->getName(),
                ':breed' => $this->getBreed(),
                ':gender' => $this->getGender(),
                ':id' => $this->getId(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM dog WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $this->getId(),
        ]);

        $this->setId(null);
        $this->setName(null);
        $this->setBreed(null);
        $this->setGender(null);
    }
}