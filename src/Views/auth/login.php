<?php
require_once __DIR__ . "/../layouts/header.php";
?>

<div class="row">
    <div class="col-md-6 offset-md-4">
        <h3 class="text-center">Login</h3>
        <form action="/login" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="mt-2 btn btn-primary">Login</button>
        </form>
    </div>
</div>



<?php
require_once __DIR__ . "/../layouts/footer.php";
?>