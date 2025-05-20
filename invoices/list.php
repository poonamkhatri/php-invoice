<?php
include('../includes/head.php');
include('queries.php');
?>

<body>
    <div id="layout-wrapper">
	    <?php include('../includes/header.php');
        include('../includes/sidebar.php'); ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Invoice List</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                        <li class="breadcrumb-item active">Listjs</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Invoice Management</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="listjs-table" id="productList">
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm-auto">
                                                <div>
                                                    <a href="create_invoice.php" class="btn btn-success add-btn">
                                                        <i class="ri-add-line align-bottom me-1"></i>Create Invoice
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="d-flex justify-content-sm-end">
                                                    <div class="search-box ms-2">
                                                        <input type="text" class="form-control search" placeholder="Search...">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if (isset($_GET['deleted'])): ?>
                                        <div class="alert alert-warning alert-top-border alert-dismissible shadow fade show" role="alert">
                                            <i class="ri-delete-bin-line me-3 align-middle fs-16 text-warning"></i><strong>Deleted</strong>
                                                - Product deleted successfully
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <?php endif; ?>


                                        <?php if (isset($_GET['success'])): ?>
    									
                                        <div class="alert alert-success alert-top-border alert-dismissible shadow fade show" role="alert">
                                            <i class="ri-notification-off-line me-3 align-middle fs-16 text-success"></i><strong>Success</strong>
                                                 - Product saved successfully
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
										<?php endif; ?>

										<div class="table-responsive table-card mt-3 mb-1">
                                        	<table class="table align-middle table-nowrap" id="productTable">
                                        		<thead class="table-light">
                                                    <tr>
                                                        <th class="sort" data-sort="customer_name">S.No</th>
                                                        <th class="sort" data-sort="product_code">Invoice No</th>
                                                    	<th class="sort" data-sort="product_name">Customer Name</th>
                                                        <th class="sort" data-sort="price">Date</th>
                                                        <th class="sort" data-sort="qty">Total</th>
                                                        <th class="sort" data-sort="action">Action</th>
                                                    </tr>
                                                </thead>
            									<tbody class="list">
                                                    <?php $sn = 1; 
                									while ($row = $result->fetch_assoc()): ?>
                									<tr>
                                                        <td><?= $sn++ ?></td>
                                                        <td class="product_code"><?= ($row['invoice_no']) ?></td>
														<td class="product_name"><?= htmlspecialchars($row['customer']) ?></td>
														<td class="price"><?= $row['invoice_date'] ?></td>
														
                                                        <td lass="unit"><?= number_format($row['total'], 2) ?></td>
														<td>
															
                                                                 <a href="invoice_view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">View</a>
                                                            

														</td>
                									</tr>
                									<?php endwhile; ?>
            									</tbody>
        									</table>
											<div class="d-flex justify-content-end">
                                                <div class="pagination-wrap hstack gap-2">
                                                    <a class="page-item pagination-prev" href="javascript:void(0);">Previous</a>
                                                    <ul class="pagination listjs-pagination mb-0"></ul>
                                                    <a class="page-item pagination-next" href="javascript:void(0);">Next</a>
                                                </div>
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
		</div>
    </div>

    <?php include('delete_modal.php'); ?>                                                          
    

    
    <script>
        function editProduct(data) {
            document.getElementById('createRecordId').value = data.id;
            document.getElementById('createName').value = data.name;
            document.getElementById('createPrice').value = data.price;
            document.getElementById('createqty').value = data.qty;
            document.getElementById('createunit').value = data.unit;
            document.getElementById('status-field').value = data.status;
            document.getElementById('modalTitle').innerText = 'Edit Product';
            new bootstrap.Modal(document.getElementById('createModal')).show();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
    
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const options = {
            valueNames: ['producr_name', 'price', 'qty', 'status','unit'],
            page: 10,
            pagination: {
                innerWindow: 1,
                left: 0,
                right: 0,
                paginationClass: "listjs-pagination"
            }
        };

        new List('productList', options);
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var customerId = button.getAttribute('data-id');
        var confirmBtn = document.getElementById('confirmDeleteBtn');
        confirmBtn.href = '?delete_id=' + customerId;
    });
});
</script>



</body>
</html>
