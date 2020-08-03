<?php

namespace App\Repository;


use App\Data\UserDTO;
use Core\DataBinderInterface;
use Database\DatabaseInterface;

class UserRepository extends DatabaseAbstract implements UserRepositoryInterface
{

    public function __construct(DatabaseInterface $database,
                                DataBinderInterface $dataBinder)
    {
        parent::__construct($database, $dataBinder);
    }

    public function insert(UserDTO $userDTO): bool
    {
        $this->db->query(
            "INSERT INTO user(first_name, last_name, email, password)
                  VALUES(?,?,?,?)
             "
        )->execute([
            $userDTO->getFirstName(),
            $userDTO->getLastName(),
            $userDTO->getEmail(),
            $userDTO->getPassword(),
        ]);

        return true;
    }

    public function update(int $id, UserDTO $userDTO): bool
    {
        $this->db->query(
            "UPDATE user
                SET
                  first_name = ?,
                  last_name = ?,
                  email = ?,
                  password = ?,
                  active = ?
                WHERE id = ?
            "
        )->execute([
            $userDTO->getFirstName(),
            $userDTO->getLastName(),
            $userDTO->getEmail(),
            $userDTO->getPassword(),
            $id
        ]);

        return true;
    }

    public function delete(int $id): bool
    {
        $this->db->query("DELETE FROM user WHERE id = ?")
            ->execute([$id]);

        return true;
    }

    public function findOneByEmail(string $email): ?UserDTO
    {
        return $this->db->query(
            "SELECT id,
                    first_name as firstName,
                    last_name as lastName,
                    email,
                    password,
                    active,
                    role
                  FROM user
                  WHERE email = ?
             "
        )->execute([$email])
            ->fetch(UserDTO::class)
            ->current();

    }

    public function findOneById(int $id): ?UserDTO
    {
        return $this->db->query(
            "SELECT id,
                    first_name as firstName,
                    last_name as lastName,
                    email,
                    password,
                    active,
                    role
                  FROM user
                  WHERE id = ?
             "
        )->execute([$id])
            ->fetch(UserDTO::class)
            ->current();
    }

    /**
     * @return \Generator|UserDTO[]
     */
    public function findAll(): \Generator
    {
        return $this->db->query(
            "SELECT id,
                    first_name as firstName,
                    last_name as lastName,
                    email,
                    password,
                    active,
                    role
                  FROM user
            "
        )->execute()
            ->fetch(UserDTO::class);
    }

}
