<?php /** @var \App\Data\BookDTO $data */ ?>

<h1>VIEW BOOK</h1>

<a href="profile.php">My Profile</a><br />

<p>Book Name: <?= $data->getName(); ?></p>
<small>Book Description: <?= $data->getDescription(); ?></small>
<p>ISBN: <?= $data->getIsbn(); ?></p>


<img src="<?= $data->getImageURL(); ?>" alt="None" width="400" height="250" />