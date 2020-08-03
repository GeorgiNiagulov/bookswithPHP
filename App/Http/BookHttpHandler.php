<?php

namespace App\Http;

use App\Data\BookDTO;
use App\Data\EditBookDTO;
use App\Service\Books\BookServiceInterface;
use App\Service\UserServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;
use App\Http\UserHttpHandler;

class BookHttpHandler extends HttpHandlerAbstract
{
  /**
   * @var BookServiceInterface
   */
  private $bookService;

  /**
   * @var UserServiceInterface
   */
  private $userService;

  /**
   * @var UserHttpHandler
   */
   private $userHttpHandler;

  public function __construct(
      TemplateInterface $template,
      DataBinderInterface $dataBinder,
      BookServiceInterface $bookService,
      UserServiceInterface $userService,
      UserHttpHandler $userHttpHandler)
  {
      parent::__construct($template, $dataBinder);
      $this->bookService = $bookService;
      $this->userService = $userService;
      $this->userHttpHandler = $userHttpHandler;
  }

  public function add(array $formData = [])
  {
      if (!$this->userService->isLogged()) {
          $this->redirect("login.php");
      }
          if($this->userService->isAdmin()) {
              if (isset($formData['add'])) {
                  $this->handleInsertProcess($formData);
              } else {
                  $this->render("books/add_book");
              }
          }
  }

  private function handleInsertProcess($formData)
  {
      try {
          $currentEmail = $this->userService->currentEmail();
          /** @var BookDTO $book */
          $book = $this->dataBinder->bind($formData, BookDTO::class);
          var_dump($book);
          $book->setUserId($currentEmail);
          $this->bookService->add($book);
          $this->redirect("my_books.php");
      } catch (\Exception $ex) {
          $this->render('books/add_book', [$ex->getMessage()]);
      }
  }

  public function allBooksByEmail()
  {
      if (!$this->userService->isLogged()) {
          $this->redirect("login.php");
      }
      try {
          $books = $this->bookService->getAllByEmail();
          $this->render("books/my_books", $books);
      }catch (\Exception $ex){
          $books = $this->bookService->getAllByEmail();
          $this->render("books/my_books", $books,
              [$ex->getMessage()]);
      }
  }

  public function allBooks()
  {
      if (!$this->userService->isLogged()) {
          $this->redirect("login.php");
      }

      try {
          $books = $this->bookService->getAll();
          $this->render("books/all_books", $books);
      }catch (\Exception $ex){
          $books = $this->bookService->getAll();
          $this->render("books/all_books", $books,
              [$ex->getMessage()]);
      }
  }

  public function view($getData = [])
  {
      if (!$this->userService->isLogged()) {
          $this->redirect("login.php");
      }

      $book = $this->bookService->getOneById($getData['id']);
      $this->render("books/view_book", $book);
  }

  public function delete($getData = [])
  {
      if (!$this->userService->isLogged()) {
          $this->redirect("login.php");
      }

      $currentEmail = $this->userService->currentEmail();
      $currentBook = $this->bookService->getOneById($getData['id']);

      if ($currentEmail->getId() === $currentBook->getUserId()->getId()) {
          $this->bookService->delete($getData['id']);
          $this->redirect("my_books.php");
      } else {
          $myBooks = $this->bookService->getAllByEmail();
          $this->render('books/all_books', $myBooks, ['Cannot delete this book!']);
      }
  }

  public function edit($formData = [], $getData = [])
  {
      if (!$this->userService->isLogged()) {
          $this->redirect("login.php");
      }

      if (isset($formData['edit'])) {
          $this->handleEditProcess($formData, $getData);
      } else {
          $book = $this->bookService->getOneById($getData['id']);

          $editBookDTO = new EditBookDTO();
          $editBookDTO->setBook($book);

          $this->render("books/edit_book", $editBookDTO);
      }
  }

  private function handleEditProcess($formData, $getData)
  {
      try {
          $user = $this->userService->currentEmail();
          /** @var BookDTO $book */
          $book = $this->dataBinder->bind($formData, BookDTO::class);
          $book->setUserId($user);
          $book->setId($getData['id']);
          $this->bookService->edit($book);
          $this->redirect("my_books.php");
      } catch (\Exception $ex) {
          $book = $this->bookService->getOneById($getData['id']);
          $editBookDto = new EditBookDTO();
          $editBookDto->setBook($book);
          $this->render('books/edit_book', $editBookDto, [$ex->getMessage()]);
      }
  }
}
