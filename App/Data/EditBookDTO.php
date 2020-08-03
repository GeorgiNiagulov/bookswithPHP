<?php

namespace App\Data;

class EditBookDTO
{
  /**
   * @var BookDTO
   */
  private $book;

  /**
   * @return BookDTO
   */
  public function getBook(): BookDTO
  {
      return $this->book;
  }

  /**
   * @param BookDTO $book
   */
  public function setBook(BookDTO $book): void
  {
      $this->book = $book;
  }
}
