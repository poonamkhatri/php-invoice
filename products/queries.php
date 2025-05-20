<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
    exit();
}
include('../config/db.php');

// Initialize form values and errors
$errors = [];
$old = ['name' => '', 'price' => '', 'qty' => '', 'unit' => '',  'status' => ''];
$hasError = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$id = $_POST['id'] ?? '';
    $old = [
        'name'    => trim($_POST['name']),
        'price'   => trim($_POST['price']),
        'qty'   => trim($_POST['qty']),
        'unit'   => trim($_POST['unit']),
        'status'  => $_POST['status']
    ];

    // Validate inputs
    if (empty($old['name'])) $errors['name'] = 'Product Name is required.';
    if (empty($old['price'])) $errors['price'] = 'Price is required.';
    if (empty($old['qty'])) $errors['qty'] = 'Quantity is required.';
      if (empty($old['unit'])) $errors['unit'] = 'Unit is required.';
    if ($old['status'] === '') $errors['status'] = 'Status is required.';

   if (empty($errors)) {
    // Auto-generate product code
    $prefix = substr(strtolower(preg_replace('/[^a-zA-Z]/', '', $old['name'])), 0, 3); // Get first 3 letters of name
    $randomNumber = rand(10000, 99999);
    $product_code = $prefix . '-' . $randomNumber;

    if (!empty($id)) {
        // For update: keep existing code or regenerate?
        $stmt = $mysqli->prepare("UPDATE products SET name=?, price=?, qty=?, unit=?, status=?, product_code=? WHERE id=?");
        $stmt->bind_param("ssssssi", $old['name'], $old['price'], $old['qty'], $old['unit'], $old['status'], $product_code, $id);
    } else {
        // For insert
        $stmt = $mysqli->prepare("INSERT INTO products (name, price, qty, unit, status, product_code) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $old['name'], $old['price'], $old['qty'], $old['unit'], $old['status'], $product_code);
    }

    if ($stmt->execute()) {
        header("Location: list.php?success=1");
        exit();
    } else {
        $hasError = true;
    }
}

}

// Handle delete
if (isset($_GET['delete_id'])) {
    //$delete_id = $_GET['delete_id'];
    $delete_id = (int)$_GET['delete_id'];
    $mysqli->query("DELETE FROM products WHERE id=$delete_id");
    header("Location: list.php?deleted=1");
    exit();
}

// Fetch all records
$result = $mysqli->query("SELECT * FROM products");
?>