<?php /** @var \App\Data\EditBookDTO $data */ ?>
<?php /** @var array $errors |null */ ?>

<h1>EDIT BOOK</h1>

<a href="profile.php">My Profile</a><br/><br/>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post">
    Book Name: <input type="text" name="title" value="<?= $data->getBook()->getName(); ?>"/> <br/>
    Book Description: <input type="text" name="author" value="<?= $data->getBook()->getDescription(); ?>"/><br/>
    Book ISBN: <textarea rows="5" name="description"><?= $data->getBook()->getIsbn();?></textarea><br/>
    Image URL: <input type="text" name="image_url" value="<?= $data->getBook()->getImageURL(); ?>"/><br/>
    <img src="<?= $data->getBook()->getImageURL(); ?>" alt="None" width="200" height="100" /><br />
    <input type="submit" value="Edit" name="edit"/><br/>
</form>