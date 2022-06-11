<?php
require_once 'DB.php';
require_once 'Session.php';
require_once 'helper.php';
require_once 'Product.php';


$success_message = Session::instance()->get('success_message');
$errors = Session::instance()->get('errors', []);

$id = isset($_GET["id"]) ? $_GET["id"] : null;
 

if (isset($id)) {
    DB::connect('localhost', 'product', 'root', '');
    $region = DB::selectOne("SELECT * from `product` where `id` = ?", [$id], 'product');


    if ($region === false) {
        echo 'Product with id ' . $id . ' not found.';
        exit();
    }
} else {
    $region = new Product();
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Product</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php if ($success_message) : ?>
            <div class="message message_success">
                <?= $success_message ?>
            </div>
        <?php endif; ?>

        <?php foreach ($errors as $error) : ?>
            <div class="message message_error">
                <?= $error ?>
            </div>
        <?php endforeach; ?>

        <?php if (isset($id)) : ?>
            <form action="save.php?id=<?= $region->id ?>" method="post">
        <?php else : ?>
            <form action="save.php" method="post">
        <?php endif; ?>
                <label>item:</label>
                <br>
                
                <input type="text" name="item" value="<?= old('item', $region->item) ?>"  />
                <br>

                <label>price:</label>
                <br>
                <input type="text" name="price" value="<?= old('price', $region->price) ?>" />

                <br/>
                <label>quantity:</label>
                <br>
                <input type="text" name="quantity" value="<?= old('quantity', $region->quantity) ?>"/>

                <br/>
                <button class="button"><span>Save</button>
                <br>

                <?php if (isset($id)) : ?>
                    <a href="delete.php?id=<?= $region->id ?>">
                        <button class="button"><span>Delete</button>
                    </a>
                <?php endif; ?>

                <br/>
                <a href="index.php">
                    <button  class="button"><span>Back</button>
                </a>
            </form>
    </body>
</html>