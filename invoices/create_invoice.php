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
                            <h4 class="mb-sm-0">Create Invoice</h4>
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
                            <form class="needs-validation" novalidate id="invoice_form" method="POST" action="save_invoice.php">
                                <div class="card-body border-bottom border-bottom-dashed p-4">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <label>Select Customer</label>
                                            <select class="form-control bg-light border-0" name="customer_id" required>
                                                <option value="">-- Select Customer --</option>
                                                <?php
                                                // Fetch customers from the database
                                                $conn = new mysqli("localhost", "root", "", "php-invoice");
                                                $customers = $conn->query("SELECT id, name FROM customers");
                                                while ($customer = $customers->fetch_assoc()):
                                                ?>
                                                    <option value="<?= $customer['id'] ?>">
                                                        <?= htmlspecialchars($customer['name']) ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-lg-3 col-sm-6">
                                            <label>Invoice No</label>
                                            <input type="text" class="form-control bg-light border-0" name="invoice_no" value="INV-<?= rand(10000000, 99999999) ?>" readonly />
                                        </div>
                                        <div class="col-lg-3 col-sm-6">
                                            <label>Payment Status</label>
                                            <select class="form-control bg-light border-0" name="payment_status" required>
                                                <option value="">Select</option>
                                                <option value="Paid">Paid</option>
                                                <option value="Unpaid">Unpaid</option>
                                                <option value="Refund">Refund</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-sm-6">
                                            <label>Total Amount</label>
                                            <input type="text" class="form-control bg-light border-0" id="totalamountInput" name="total_amount" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="table-responsive">
                                        <table class="invoice-table table table-borderless table-nowrap mb-0">
                                            <thead class="align-middle">
                                                <tr class="table-active">
                                                    <th>#</th>
                                                    <th>Product Details</th>
                                                    <th>Rate ($)</th>
                                                    <th>Quantity</th>
                                                    <th class="text-end">Amount</th>
                                                    <th class="text-end"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="invoice-items">
                                                <tr class="product-row">
                                                    <th class="product-index">1</th>
                                                    <td>
                                                        <select class="form-select bg-light border-0 product-select" name="product_id[]" required>
                                                            <option value="">-- Select Product --</option>
                                                            <?php
                                                            $products = $conn->query("SELECT id, name, price FROM products");
                                                            while ($p = $products->fetch_assoc()): ?>
                                                                <option value="<?= $p['id'] ?>" data-price="<?= $p['price'] ?>">
                                                                    <?= htmlspecialchars($p['name']) ?> - $<?= $p['price'] ?>
                                                                </option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control bg-light border-0 product-price" name="rate[]" step="0.01" readonly required />
                                                    </td>
                                                    <td>
                                                        <div class="input-step">
                                                            <button type="button" class="minus">–</button>
                                                            <input type="number" name="quantity[]" class="product-quantity" value="1" readonly>
                                                            <button type="button" class="plus">+</button>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                        <input type="text" class="form-control bg-light border-0 product-line-price" name="line_total[]" value="$0.00" readonly />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger remove-row">Delete</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-outline-primary" id="add-item">+ Add Product</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-end">
                                    <button type="submit" class="btn btn-success">Save Invoice</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../includes/footer.php'); ?>
    </div>
</div>

<?php include('../includes/script.php'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  function updateAmounts() {
    let total = 0;
    document.querySelectorAll('.product-row').forEach(row => {
      const price = parseFloat(row.querySelector('.product-price').value || 0);
      const qty = parseInt(row.querySelector('.product-quantity').value || 1);
      const lineTotal = price * qty;
      row.querySelector('.product-line-price').value = "$" + lineTotal.toFixed(2);
      total += lineTotal;
    });
    document.getElementById('totalamountInput').value = "$" + total.toFixed(2);
  }

  function reindexRows() {
    document.querySelectorAll('.product-index').forEach((el, i) => {
      el.textContent = i + 1;
    });
  }

  document.getElementById('invoice-items').addEventListener('change', function (e) {
    if (e.target.classList.contains('product-select')) {
      const selectedOption = e.target.options[e.target.selectedIndex];
      const price = selectedOption.getAttribute('data-price') || 0;
      e.target.closest('tr').querySelector('.product-price').value = price;
      updateAmounts();
    }
  });

  document.getElementById('invoice-items').addEventListener('click', function (e) {
    const row = e.target.closest('.product-row');
    if (e.target.classList.contains('plus')) {
      let qty = row.querySelector('.product-quantity');
      qty.value = parseInt(qty.value) + 1;
      updateAmounts();
    } else if (e.target.classList.contains('minus')) {
      let qty = row.querySelector('.product-quantity');
      qty.value = Math.max(1, parseInt(qty.value) - 1);
      updateAmounts();
    } else if (e.target.classList.contains('remove-row')) {
      row.remove();
      reindexRows();
      updateAmounts();
    }
  });

  document.getElementById('add-item').addEventListener('click', function () {
    const table = document.getElementById('invoice-items');
    const firstRow = table.querySelector('.product-row');
    const newRow = firstRow.cloneNode(true);

    // Reset all values in cloned row
    newRow.querySelector('.product-select').selectedIndex = 0;
    newRow.querySelector('.product-price').value = '';
    newRow.querySelector('.product-quantity').value = 1;
    newRow.querySelector('.product-line-price').value = '$0.00';

    // Append and update
    table.appendChild(newRow);
    reindexRows();
    updateAmounts();
  });

  updateAmounts();
});
</script>

