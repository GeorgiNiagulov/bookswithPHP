<?php /** @var \App\Data\UserDTO $data */ ?>
<?php /** @var array $errors |null */ ?>

<h2>Your Profile</h2>

<?php foreach ($errors as $error): ?>
    <p style="color: red"><?= $error ?></p>
<?php endforeach; ?>

<form method="post">
    <label>
        First Name: <input type="text" name="first_name" value="<?= $data->getFirstName(); ?>" /> <br/>
    </label>
    <label>
        Last Name: <input type="text" name="last_name" value="<?= $data->getLastName(); ?>" /> <br/>
    </label>
    <label>
        Email: <input type="text" name="email" value="<?= $data->getEmail(); ?>" /> <br/>
    </label>
    <label>
        Password: <input type="password" name="password" /> <br/>
    </label>
    <input type="submit" name="edit" value="Edit"/> <br/>

</form>

You can <a href="logout.php">logout</a> or see <a href="all.php">all users</a>.