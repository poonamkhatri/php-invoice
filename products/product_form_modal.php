<!-- Create & Edit Modal -->
<div class="modal fade <?= $hasError ? 'show d-block' : '' ?>" id="createModal" tabindex="-1" <?= $hasError ? 'style="background: rgba(0,0,0,0.5);"' : '' ?>>
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header bg-light p-3">
			    <h5 class="modal-title" id="modalTitle"><?= !empty($_POST['id']) ? 'Edit' : 'Add' ?> Product</h5>
                <a href="list.php" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="createRecordId" value="<?= htmlspecialchars($_POST['id'] ?? '') ?>">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" id="createName" class="form-control" value="<?= htmlspecialchars($old['name']) ?>">
                    <?php if (!empty($errors['name'])): ?><small class="text-danger"><?= $errors['name'] ?></small><?php endif; ?>
                </div>
                <div class="mb-3">
                    <label>Price</label>
                    <input type="price" name="price" id="createPrice" class="form-control" value="<?= htmlspecialchars($old['price']) ?>">
                    <?php if (!empty($errors['price'])): ?><small class="text-danger"><?= $errors['price'] ?></small><?php endif; ?>
                </div>
                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="text" name="qty" id="createqty" class="form-control" value="<?= htmlspecialchars($old['qty']) ?>">
                    <?php if (!empty($errors['qty'])): ?><small class="text-danger"><?= $errors['qty'] ?></small><?php endif; ?>
                </div>
                <div class="mb-3">
                    <label>Unit</label>
                    <input type="text" name="unit" id="createunit" class="form-control" value="<?= htmlspecialchars($old['unit']) ?>">
                    <?php if (!empty($errors['unit'])): ?><small class="text-danger"><?= $errors['unit'] ?></small><?php endif; ?>
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" id="status-field" class="form-select">
                        <option value="">Select</option>
                        <option value="1" <?= $old['status'] === '1' ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= $old['status'] === '0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                    <?php if (!empty($errors['status'])): ?><small class="text-danger"><?= $errors['status'] ?></small><?php endif; ?>
                </div>
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button class="btn btn-success" type="submit">Save Product</button>
                    <a href="list.php" class="btn btn-secondary">Close</a>
                </div>
            </div>
        </form>
    </div>
</div>