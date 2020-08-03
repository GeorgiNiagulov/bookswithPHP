<?php /** @var \App\Data\UserDTO $data */ ?>

<h1>Hello, <?= $data->getFirstName(); ?></h1>
<?php if($data->getRole() === "admin"): ?>
    <a href="all.php">All users</a>|
<?php endif; ?>
    <a href="my_profile.php">Edit Profile</a> |
    <a href="logout.php">logout</a>
    <br /><br />
<?php if($data->getRole() === "admin"): ?>
    <a href="add_book.php">Add new book</a>|
<?php endif; ?>
<a href="my_books.php">My Books</a> <br />
<a href="all_books.php">All Books</a>
