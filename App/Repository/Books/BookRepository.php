<?php

namespace App\Repository\Books;

use App\Data\BookDTO;
use App\Data\UserDTO;
use App\Repository\DatabaseAbstract;

class BookRepository extends DatabaseAbstract implements BookRepositoryInterface
{
  public function insert(BookDTO $bookDTO): bool
  {
      $this->db->query(
          "
               INSERT INTO book(
                    name,
                    isbn,
                    description,
                    image_url,
                    user_id)
                VALUES (?,?,?,?,?)
          ")->execute([
          $bookDTO->getName(),
          $bookDTO->getIsbn(),
          $bookDTO->getDescription(),
          $bookDTO->getImageUrl(),
          $bookDTO->getUserId()->getId()
      ]);

      return true;
  }

  public function update(BookDTO $bookDTO, int $id): bool
  {
      $this->db->query(
          "
               UPDATE book
               SET
                    name = ?,
                    isbn = ?,
                    description = ?,
                    image_url = ?,
                    user_id = ?
               WHERE id = ?
          ")->execute([
          $bookDTO->getName(),
          $bookDTO->getIsbn(),
          $bookDTO->getDescription(),
          $bookDTO->getImageUrl(),
          $bookDTO->getUserId()->getId(),
          $id
      ]);

      return true;
  }

  public function remove(int $id): bool
  {
      $this->db->
      query("DELETE FROM book WHERE id = ?")
          ->execute([$id]);
      return true;
  }

  /**
   * @return \Generator|BookDTO[]
   */
  public function findAll(): \Generator
  {
      $lazyBookResult = $this->db->query(
          "
                SELECT
                    b.id as bookId,
                    b.name,
                    b.isbn,
                    b.description,
                    b.image_url,
                    b.user_id,
                    u.id as userId,
                    u.email,
                    u.password,
                    u.first_name,
                    u.last_name,
                    u.active,
                    u.role
                FROM book as b
                INNER JOIN user as u on b.user_id = u.id
                ORDER BY b.name DESC
          ")->execute()
          ->fetchAssoc();

      foreach ($lazyBookResult as $row) {

          /** @var BookDTO $book */
          /** @var UserDTO $user */
          $book = $this->dataBinder->bind($row, BookDTO::class);
          $user = $this->dataBinder->bind($row, UserDTO::class);
          $book->setId($row['bookId']);
          $user->setId($row['userId']);
          $book->setUserId($user);

          yield $book;
      }
  }

  public function findOneById(int $id): BookDTO
  {
      $row = $this->db->query(
          "
                SELECT
                  b.id as bookId,
                  b.name,
                  b.isbn,
                  b.description,
                  b.image_url,
                  b.user_id,
                  u.id as userId,
                  u.email,
                  u.password,
                  u.first_name,
                  u.last_name,
                  u.active,
                  u.role
                FROM book as b
                INNER JOIN user as u on b.user_id = u.id
                WHERE b.id = ?
                ORDER BY b.name DESC
          ")->execute([$id])
              ->fetchAssoc()
          ->current();

      /** @var BookDTO $book */
      /** @var UserDTO $user */
      $book = $this->dataBinder->bind($row, BookDTO::class);
      $user = $this->dataBinder->bind($row, UserDTO::class);
      $book->setId($row['bookId']);
      $user->setId($row['userId']);
      $book->setUserId($user);

      return $book;
  }

  /**
   * @param int $id
   * @return \Generator|BookDTO[]
   */
  public function findAllByEmailId(int $id): \Generator
  {
      $lazyBookResult = $this->db->query(
          "
                SELECT
                  b.id as bookId,
                  b.name,
                  b.isbn,
                  b.description,
                  b.image_url,
                  b.user_id,
                  u.id as userId,
                  u.email,
                  u.password,
                  u.first_name,
                  u.last_name,
                  u.active,
                  u.role
                FROM book as b
                INNER JOIN user as u on b.user_id = u.id
                WHERE b.user_id = ?
                ORDER BY b.name DESC
          ")->execute([$id])
          ->fetchAssoc();

      foreach ($lazyBookResult as $row) {

          /** @var BookDTO $book */
          /** @var UserDTO $user */
          $book = $this->dataBinder->bind($row, BookDTO::class);
          $user = $this->dataBinder->bind($row, UserDTO::class);
          $book->setId($row['bookId']);
          $user->setId($row['userId']);
          $book->setUserId($user);

          yield $book;
      }

  }
}
