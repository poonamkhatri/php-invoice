<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
    exit();
}
include('../config/db.php');

// Initialize form values and errors
$errors = [];
$old = ['name' => '', 'email' => '', 'phone' => '', 'address' => '', 'status' => ''];
$hasError = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$id = $_POST['id'] ?? '';
    $old = [
        'name'    => trim($_POST['name']),
        'email'   => trim($_POST['email']),
        'phone'   => trim($_POST['phone']),
        'address' => trim($_POST['address']),
        'status'  => $_POST['status']
    ];

    // Validate inputs
    if (empty($old['name'])) $errors['name'] = 'Name is required.';
    if (empty($old['email'])) $errors['email'] = 'Email is required.';
    if (empty($old['phone'])) $errors['phone'] = 'Phone is required.';
    if (empty($old['address'])) $errors['address'] = 'Address is required.';
    if ($old['status'] === '') $errors['status'] = 'Status is required.';

    // If no errors, insert or update
    if (empty($errors)) {
        if (!empty($id)) {
            $stmt = $mysqli->prepare("UPDATE customers SET name=?, email=?, phone=?, address=?, status=? WHERE id=?");
            $stmt->bind_param("sssssi", $old['name'], $old['email'], $old['phone'], $old['address'], $old['status'], $id);
        } else {
            $stmt = $mysqli->prepare("INSERT INTO customers (name, email, phone, address, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $old['name'], $old['email'], $old['phone'], $old['address'], $old['status']);
        }

        if ($stmt->execute()) {
            header("Location: list.php?success=1");
            exit();
        } else {
            $hasError = true;
        }
    } else {
        $hasError = true;
    }
}

// Handle delete
if (isset($_GET['delete_id'])) {
    //$delete_id = $_GET['delete_id'];
    $delete_id = (int)$_GET['delete_id'];
    $mysqli->query("DELETE FROM customers WHERE id=$delete_id");
    header("Location: list.php?deleted=1");
    exit();
}

// Fetch all records
$result = $mysqli->query("SELECT * FROM customers");
?>