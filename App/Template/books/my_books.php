<?php /** @var \App\Data\BookDTO[] $data */ ?>

<h1>MY BOOKS</h1>

<!-- <php if($data->getUser()->getId() === "admin"): ?> -->
    <a href="add_book.php">Add new book</a>|
<!-- <php endif; ?> | -->
<a href="my_profile.php">My Profile</a> |
<a href="logout.php">logout</a>

<br /><br />

<table border="1">
    <thead>
    <tr>
        <th>Name</th>
        <th>ISBN</th>
        <th>Description</th>
        <th>Image</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($data as $bookDTO): ?>
        <tr>
          <?php var_dump($bookDTO); ?>
            <td><?= $bookDTO->getName(); ?></td>
            <td><?= $bookDTO->getISBN(); ?></td>
            <td><?= $bookDTO->getDescription(); ?></td>
            <td><img src="<?= $bookDTO->getImageURL(); ?>" alt="None" width="200" height="100" /></td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>
