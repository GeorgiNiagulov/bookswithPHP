
<?php /** @var array $errors |null */ ?>

<h1>ADD NEW BOOK</h1>

<a href="profile.php">My Profile</a><br/><br />

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post" enctype="multipart/form-data">
    Name of Book: <input type="text" name="name"/> <br />
    Description: <textarea rows="5" name="description"></textarea><br />
    ISBN:        <input type="text" name="isbn"/> <br />
    Image:       <input type="text" name="image_url" /> <br />
    <input type="submit" value="Add" name="add" /><br />
</form>