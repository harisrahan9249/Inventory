<?php

require_once 'DB.php';
require_once 'Session.php';
require_once 'Product.php';

DB::connect('localhost', 'product', 'root', '');
$id = isset($_GET["id"]) ? $_GET["id"] : null;

if (isset($id)) {
    $region = DB::selectOne("SELECT * from `product` where `id` = ?", [$id], 'Product');

    if ($region === false) {
        echo 'Product with id ' . $id . ' not found.';
        exit();
    }
} else {
    $region = new Product();
}

$valid = true;
$errors = [];

if (empty($_POST['item'])) {
    $valid = false;
    $errors[] = 'The item field is mandatory';
}

if (empty($_POST['price'])) {
    $valid = false;
    $errors[] = 'The price field is mandatory';
}
if (empty($_POST['quantity'])) {
    $valid = false;
    $errors[] = 'The quantity field is mandatory';
}

if ($valid === false) {
    Session::instance()->flashRequest();
    Session::instance()->flash('errors', $errors);

    if ($id) {
        header('Location: edite.php?id=' . $id);
    } else {
        header('Location: edite.php');
    }

    exit();
}

$region->item = $_POST['item'] ?? $region->item;
$region->price = $_POST['price'] ?? $region->price;
$region->quantity = $_POST['quantity'] ?? $region->quantity;
$region->save();

Session::instance()->flash('success_message', 'Product successfully saved');

header('Location: edite.php?id=' . $region->id);