<?php /** @var \App\Data\BookDTO[] $data */ ?>
<?php /** @var array $errors |null */ ?>

<h1>ALL BOOKS</h1>

<a href="add_book.php">Add new book</a> |
<a href="my_profile.php">My Profile</a> |
<a href="logout.php">logout</a>

<br /><br />

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<table border="1">
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>ISBN</th>
        <th>Image</th>
        <th>Details</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($data as $bookDTO): ?>
        <tr>
            <td><?= $bookDTO->getName(); ?></td>
            <td><?= $bookDTO->getDescription(); ?></td>
            <td><?= $bookDTO->getIsbn(); ?></td>
            <td><?= $bookDTO->getImageUrl(); ?></td>
            <td><a href="view_book.php?id=<?= $bookDTO->getId(); ?>">details</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>