<?php

namespace App\Data;

class UserDTO
{
  private const FIRSTNAME_MIN_LENGTH = 3;
  private const FIRSTNAME_MAX_LENGTH = 50;

  private const LASTNAME_MIN_LENGTH = 3;
  private const LASTNAME_MAX_LENGTH = 50;

  private const PASSWORD_MIN_LENGTH = 4;
  private const PASSWORD_MAX_LENGTH = 255;

  /**
   * @var integer
   */
  private $id;

  /**
   * @var string
   */
  private $firstName;

  /**
   * @var string
   */
  private $lastName;

  /**
   * @var string
   */
  private $email;

  /**
   * @var string
   */
    private $password;

  /**
   * @var bool
   */
    private $active;

  /**
   * @var string
   */
  private $role;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }



  public function getId()
  {
      return $this->id;
  }

  public function getFirstName()
  {
      return $this->firstName;
  }

  /**
   * @param $firstName
   * @return UserDTO
   * @throws \Exception
   */
  public function setFirstName($firstName): UserDTO
  {
      DTOValidator::validate(self::FIRSTNAME_MIN_LENGTH, self::FIRSTNAME_MAX_LENGTH,
          $firstName, "text", "first Name");
      $this->firstName = $firstName;
      return $this;
  }

  public function getLastName()
  {
      return $this->lastName;
  }

  /**
   * @param $lastName
   * @return UserDTO
   * @throws \Exception
   */
  public function setLastName($lastName): UserDTO
  {
      DTOValidator::validate(self::LASTNAME_MIN_LENGTH, self::LASTNAME_MAX_LENGTH,
          $lastName, "text", "last Name");
      $this->lastName = $lastName;
      return $this;
  }

  public function getEmail()
  {
    return $this->email;
  }

  /**
   * @param $email
   * @return UserDTO
   * @throws \Exception
   */
  public function setEmail($email): UserDTO
  {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->email = $email;
      return $this;
    } else {
      throw new \Exception("{$email} is considered invalid.\n");
    }
  }

  public function getPassword()
  {
      return $this->password;
  }

  /**
   * @param $password
   * @return UserDTO
   * @throws \Exception
   */
  public function setPassword($password): UserDTO
  {
      DTOValidator::validate(self::PASSWORD_MIN_LENGTH, self::PASSWORD_MAX_LENGTH,
          $password, "text", "Password");
      $this->password = $password;
      return $this;
  }

    public function getActive()
    {
        return $this->active;
    }

    /**
     *
     * @param bool $active
     * @return UserDTO
     * @throws \Exception
     */
    public function setActive($active): UserDTO
    {
      if (filter_var($active, FILTER_VALIDATE_BOOLEAN)) {
          $this->active = $active;
          return $this;
      } else {
          throw new \Exception("Value of $active must be boolean.\n");
      }
    }

    /**
     * @return string
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

}
