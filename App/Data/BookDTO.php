<?php

namespace App\Data;

use Biblys\Isbn\Isbn as Isbn;

class BookDTO
{
  private CONST NAME_MIN_LENGTH=3;
  private CONST NAME_MAX_LENGTH=50;

  private CONST DESCRIPTION_MIN_LENGTH=10;
  private CONST DESCRIPTION_MAX_LENGTH=10000;

  private CONST IMAGE_URL_MIN_LENGTH=10;
  private CONST IMAGE_URL_MAX_LENGTH=10000;

  /**
   * @var integer
   */
  private $id;

  /**
   * @var string
   */
  private $name;

  /**
   * @var string
   */
   private $isbn;

  /**
   * @var string
   */
  private $description;

  /**
   * @var string
   *
   */
  private $imageUrl;

  /**
   * @var UserDTO
   */
  private $userId;

  /**
   * @param int $id
   */
  public function setId(int $id): void
  {
      $this->id = $id;
  }

  /**
   * @return int
   */
  public function getId(): int
  {
      return $this->id;
  }

  /**
   * @return string
   */
  public function getName(): string
  {
      return $this->name;
  }

  /**
   * @param string $name
   * @throws \Exception
   */
  public function setName(string $name): void
  {
      DtoValidator::validate(
          self::NAME_MIN_LENGTH,
          self::NAME_MAX_LENGTH,
          $name,
          'text',
          'Name');
      $this->name = $name;
  }

  /**
   * @return string
   */
  public function getIsbn(): string
  {
      return $this->isbn;
  }

  /**
   * @param string $isbn
   * @throws \Exception
   */
   public function setIsbn($isbn): void
   {
       $ean = new Isbn($isbn);
       try {
           $ean->validate();
           $isbn13 = $ean->format("ISBN-13");
           echo "ISBN-13: $isbn13";
       } catch(Exception $e) {
           echo "An error occured while parsing $isbn: ".$e->getMessage();
       }
   }

  /**
   * @return string
   */
  public function getDescription(): string
  {
      return $this->description;
  }

  /**
   * @param string $description
   * @throws \Exception
   */
  public function setDescription(string $description): void
  {
      DtoValidator::validate(
          self::DESCRIPTION_MIN_LENGTH,
          self::DESCRIPTION_MAX_LENGTH,
          $description,
          'text',
          'Description');
      $this->description = $description;
  }

  /**
   * @return UserDTO
   */
  public function getUserId(): UserDTO
  {
      return $this->userId;
  }

  /**
   * @param UserDTO $userId
   */
  public function setUserId(UserDTO $userId): void
  {
      $this->userId = $userId;
  }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }



}
