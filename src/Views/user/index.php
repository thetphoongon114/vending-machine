<?php
require_once __DIR__ . "/../layouts/header.php";
require_once __DIR__ . "/../../config/helpers.php";
?>

<div class="d-flex justify-content-between">
    <h3>Users</h3>
</div>
<hr>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <?php if(checkAdmin()): ?>
                    <a href="/user/<?= $user['id'] ?>" class="btn btn-warning">Edit</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php
require_once __DIR__ . "/../layouts/footer.php";
?>