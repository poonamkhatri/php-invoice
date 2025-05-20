<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
    exit();
}
include('../config/db.php');

$result = $mysqli->query("SELECT invoices.id,invoices.invoice_no, customers.name AS customer, invoices.invoice_date, invoices.total
                        FROM invoices JOIN customers ON invoices.customer_id = customers.id
                        ORDER BY invoices.id DESC");

$id = (int) $_GET['id'];

$invoice = $mysqli->query("SELECT invoices.*, customers.name AS customer
                         FROM invoices JOIN customers ON invoices.customer_id = customers.id
                         WHERE invoices.id = $id")->fetch_assoc();

$items = $mysqli->query("SELECT products.name, invoice_items.quantity, invoice_items.price
                       FROM invoice_items
                       JOIN products ON invoice_items.product_id = products.id
                       WHERE invoice_items.invoice_id = $id");
?>
