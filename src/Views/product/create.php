<?php
require_once __DIR__ . "/../layouts/header.php";
require_once __DIR__ . "/../../config/helpers.php";
?>

<div class="row">
    <div class="col-md-6 offset-md-4">
        <h3 class="text-center">Create Product Form</h3>
        <?php if (isset($_SESSION['validation'])): ?>
            <div class='alert alert-warning'><?= $_SESSION['validation'] ?></div>
        <?php endif; unset($_SESSION['validation']); ?>
        <form action="/product" method="POST">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" required placeholder="write product name">
            </div>
            <div class="form-group mt-2">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" step="0.01" required placeholder="write product price">
            </div>
            <div class="form-group mt-2">
                <label for="quantity_available">Quantity Available</label>
                <input type="number" name="quantity_available" class="form-control" required placeholder="write product quantity">
            </div>
            <button type="submit" class="mt-2 btn btn-primary"> Create </button>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . "/../layouts/footer.php";
?>