<?php
require_once __DIR__ . "/../layouts/header.php";
require_once __DIR__ . "/../../config/helpers.php";
?>

<div class="row">
    <div class="col-md-6 offset-md-4">
        <div class="card " style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($product['name'])  ?></h5>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe quo eveniet aperiam ad eius sint sapiente atque tempore, aliquid id, quaerat dolorem expedita </p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price : <?php echo htmlspecialchars($product['price']);  ?> USD </li>
                    <li class="list-group-item">Quantity Available : <?php echo htmlspecialchars($product['quantity_available']);  ?></li>
                </ul>
            </div>

            <div class="card-footer d-flex justify-content-center">
                <?php if ($product['quantity_available'] != 0 && !checkAdmin()): ?>
                    <form action="/product/<?php echo $product['id']; ?>/purchase" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-primary">Purchase</button>
                    </form>
                <?php else: ?>
                    <a href="#" class="btn btn-primary disabled">Purchase</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . "/../layouts/footer.php";
?>