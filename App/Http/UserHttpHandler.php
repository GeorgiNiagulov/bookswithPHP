<?php

namespace App\Http;

use App\Data\UserDTO;
use App\Service\UserServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;

class UserHttpHandler extends HttpHandlerAbstract
{
  /**
   * @var UserServiceInterface
   */
    private $userService;

  public function __construct(
      TemplateInterface $template,
      DataBinderInterface $dataBinder,
      UserServiceInterface $userService,
      UserDTO $userDTO)
  {
      parent::__construct($template, $dataBinder);
      $this->userService = $userService;
  }

  public function myProfile(array $formData = [])
  {
      if (!$this->userService->isLogged()) {
          $this->redirect("login.php");
      }

      if (isset($formData['edit'])) {
          $this->handleEditProcess($formData);
      } else {
          $currentEmail = $this->userService->currentEmail();
          $this->render("users/my_profile", $currentEmail);
      }

  }

  public function index()
  {
      $this->render("home/index");
  }

  public function all()
  {
      $this->render("users/all", $this->userService->getAll());
  }

  public function profile()
  {
      if (!$this->userService->isLogged()) {
          $this->redirect("login.php");
      }

      $currentEmail = $this->userService->currentEmail();
      $this->render("users/profile", $currentEmail);
  }

  public function login(array $formData = [])
  {
      $email = "";
      if (isset($formData['login'])) {
          $this->handleLoginProcess($formData);
      } else {
          if(isset($_SESSION['email'])){
              $email = $_SESSION['email'];
          }
          $this->render("users/login",
              $email === "" ? "" : $email);
      }
  }

  public function register(array $formData = [])
  {
      if (isset($formData['register'])) {
          $this->handleRegisterProcess($formData);
      } else {
          $this->render("users/register");
      }
  }

  private function handleRegisterProcess($formData)
  {
      try {
          /** @var UserDTO $email */
          $email = $this->dataBinder->bind($formData, UserDTO::class);
          $this->userService->register($email, $formData['confirm_password']);
          $_SESSION['email'] = $email->getEmail();
          $this->redirect("login.php");
      } catch (\Exception $ex) {
          $this->render("users/register", null,
              [$ex->getMessage()]);
      }
  }

  private function handleLoginProcess($formData)
  {
      try {
          $email = $this->userService->login($formData['email'], $formData['password']);
          $currentEmail = $this->dataBinder->bind($formData, UserDTO::class);
          if (null !== $email) {
              $_SESSION['id'] = $email->getId();
              $this->redirect("profile.php");
          }
      } catch (\Exception $ex) {
          $this->render("users/login", null,
              [$ex->getMessage()]);
      }

  }

  private function handleEditProcess($formData)
  {
      try{
          $email = $this->dataBinder->bind($formData, UserDTO::class);
          $this->userService->edit($email);
          $this->redirect("profile.php");
      } catch (\Exception $ex) {
          $currentEmail = $this->userService->currentEmail();
          $this->render("users/my_profile", $currentEmail,
              [$ex->getMessage()]);
      }
  }

}
