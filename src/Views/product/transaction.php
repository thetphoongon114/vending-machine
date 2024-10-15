<?php
require_once __DIR__ . "/../layouts/header.php";
require_once __DIR__ . "/../../config/helpers.php";
?>

<div class="d-flex justify-content-between">
    <h3>Transactions</h3>
</div>
<hr>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Product</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $index => $transaction): ?>
            <tr>
                <td><?= ++$index ?></td>
                <td><?= $transaction['user_name'] ?></td>
                <td><?= $transaction['product_name'] ?></td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php
require_once __DIR__ . "/../layouts/footer.php";
?>