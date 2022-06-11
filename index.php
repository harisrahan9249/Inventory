<?php

require_once 'DB.php';
require_once 'Session.php';
require_once 'Product.php';

$success_message = Session::instance()->get('success_message');

DB::connect('localhost', 'product', 'root', '');

$data = DB::select("SELECT * FROM `product` ",[], 'Product');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>product</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php if ($success_message) : ?>
            <div class="message message_success">
                <?= $success_message ?>
            </div>
        <?php endif; ?>

        <div>
            <a href="edite.php"><button class="button"><span>Create new product</span></button></a>
            <hr>
            <hr>

            <?php foreach ($data as $region) : ?>
                <h2><?= $region->item ?></h2>
                <h3><?= $region->price ?></h3>
                <h3><?= $region->quantity ?></h3>

                <a href="edite.php?id=<?= $region->id ?>"><button class="button"><span>Edit</span></button></a>
            <hr>
            <?php endforeach; ?>
        </div>
    </body>
</html>