<?php
require_once __DIR__ . "/../layouts/header.php";
?>

<div class="row">
    <div class="col-md-6 offset-md-4">
        <h3 class="text-center">Edit User Form</h3>
        <form action="/user/<?= $user['id'] ?>/update" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
            </div>
            <div class="form-group mt-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" value="<?= $user['email'] ?>" step="0.01" disabled>
            </div>
            <div class="form-group mt-2">
                <label for="role">Role</label>
                <select name="role" class="form-control">
                    <option value="Admin" <?= $user['role'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="User" <?= $user['role'] === 'User' ? 'selected' : '' ?>>User</option>
                </select>
            </div>
            <button type="submit" class="mt-2 btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . "/../layouts/footer.php";
?>