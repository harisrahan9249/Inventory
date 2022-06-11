<?php

require_once 'DB.php';
require_once 'Session.php';
require_once 'Product.php';

$id = $_GET["id"];

DB::connect('localhost', 'product', 'root', '');
$region = DB::selectOne("SELECT * from `product` where `id` = ?", [$id], 'Product');

if ($region === false) {
    echo 'Product with id ' . $id . ' not found.';
    exit();
}

$region->delete();
Session::instance()->flash('success_message', 'Product successfully deleted');

header('Location: index.php');