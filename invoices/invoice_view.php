<?php
include('../includes/head.php');
include('queries.php');
?>

<div id="layout-wrapper">
    <?php include('../includes/header.php'); include('../includes/sidebar.php'); ?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Invoice</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                                    <li class="breadcrumb-item active">Create Invoice</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xxl-9">
                        <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Invoice #<?= $invoice['invoice_no'] ?? 'INV-XXXX' ?></h5>
        <?php
$status = $invoice['payment_status'] ?? 'Unpaid'; // default fallback
$badgeClass = match ($status) {
    'Paid' => 'success',
    'Refund' => 'info',
    default => 'warning', // for 'Unpaid' or anything else
};
?>
<span class="badge bg-<?= $badgeClass ?>">
    <?= $status ?>
</span>
    </div>

    <div class="card-body">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h6>Invoice To:</h6>
                <p class="mb-1"><?= $invoice['customer'] ?></p>
                <p class="mb-1"><?= $invoice['customer_email'] ?? '' ?></p>
                <p><?= $invoice['customer_address'] ?? '' ?></p>
            </div>
            <div class="col-sm-6 text-sm-end">
                <h6>Invoice Details:</h6>
                <p class="mb-1"><strong>Date:</strong> <?= date('d M Y', strtotime($invoice['created_at'])) ?></p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $i = 1;
                    while ($item = $items->fetch_assoc()):
                        $subtotal = $item['quantity'] * $item['price'];
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'], 2) ?></td>
                        <td class="text-end"><?= number_format($subtotal, 2) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total</strong></td>
                        <td class="text-end"><strong><?= number_format($total, 2) ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-4 text-end">
            <a href="list.php" class="btn btn-secondary">Back to List</a>
            <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
        </div>
    </div>
</div>

                    </div>
                </div>
            </div>
        </div>
        <?php include('../includes/footer.php'); ?>
    </div>
</div>

<?php include('../includes/scripts.php'); ?>

