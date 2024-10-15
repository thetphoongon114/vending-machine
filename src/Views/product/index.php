<?php
require_once __DIR__ . "/../layouts/header.php";
require_once __DIR__ . "/../../config/helpers.php";
?>

<div class="d-flex justify-content-between">
    <h3>Products</h3>
    <?php if (checkAdmin()): ?>
        <a href="/product" type="button" class="btn btn-outline-success"> Add Product</a>
    <?php endif; ?>
</div>
<hr>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity Available</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] ?> USD</td>
                <td><?= $product['quantity_available'] ?></td>
                <td>
                    <a href="/product/<?php echo $product['id']; ?>/detail" class="btn btn-info">Detail</a>
                    <?php if (checkAdmin()): ?>
                        <a href="/product/<?php echo $product['id']; ?>" class="btn btn-warning">Edit</a>
                        <form action="/product/<?php echo $product['id']; ?>/delete" method="POST" style="display:inline;">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php
require_once __DIR__ . "/../layouts/footer.php";
?>