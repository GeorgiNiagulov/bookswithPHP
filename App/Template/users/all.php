<?php /** @var \App\Data\UserDTO[] $data */ ?>

<table border="1">
    <thead>
    <tr>
        <td>Firstname</td>
        <td>Lastname</td>
        <td>Email</td>
        <td>Is it Active</td>
        <td>Is it admin?</td>
    </tr>
    </thead>

    <tbody>
        <?php foreach ($data as $userDTO): ?>
            <tr>
                <td><?= $userDTO->getFirstName(); ?></td>
                <td><?= $userDTO->getLastName(); ?></td>
                <td><?= $userDTO->getEmail(); ?></td>
                <td><?= $userDTO->getActive() == false ? "no" : "yes"; ?></td>
                <td><?= $userDTO->getRole() == "admin" ? "yes" : "no"; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<br />
Go back to <a href="profile.php">your profile</a>