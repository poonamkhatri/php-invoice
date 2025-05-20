<?php
$conn = new mysqli("localhost", "root", "", "php-invoice");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture POST data safely
$customer_id     = $_POST['customer_id'];
$invoice_no      = $_POST['invoice_no'];
$payment_status  = $_POST['payment_status'];
$products        = $_POST['product_id'];
$quantities      = $_POST['quantity'];

// Start transaction
$conn->begin_transaction();

try {
    // Insert invoice (assuming 'date' column has DEFAULT CURRENT_TIMESTAMP)
    $stmt = $conn->prepare("INSERT INTO invoices (invoice_no, customer_id, payment_status, total) VALUES (?, ?, ?, 0)");
    $stmt->bind_param("sis", $invoice_no, $customer_id, $payment_status);
    $stmt->execute();
    $invoice_id = $stmt->insert_id;

    $total = 0;

    // Insert invoice items
    foreach ($products as $index => $product_id) {
        $quantity = $quantities[$index];

        // Get price from products table
        $res = $conn->prepare("SELECT price FROM products WHERE id = ?");
        $res->bind_param("i", $product_id);
        $res->execute();
        $res->bind_result($price);
        $res->fetch();
        $res->close();

        $line_total = $price * $quantity;
        $total += $line_total;

        $stmt = $conn->prepare("INSERT INTO invoice_items (invoice_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $invoice_id, $product_id, $quantity, $price);
        $stmt->execute();
    }

    // Update invoice total
    $stmt = $conn->prepare("UPDATE invoices SET total = ? WHERE id = ?");
    $stmt->bind_param("di", $total, $invoice_id);
    $stmt->execute();

    $conn->commit();
    header("Location: list.php");
    exit;
} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}
?>
