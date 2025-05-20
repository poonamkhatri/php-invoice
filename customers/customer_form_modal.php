<!-- Create & Edit Modal -->
<div class="modal fade <?= $hasError ? 'show d-block' : '' ?>" id="createModal" tabindex="-1" <?= $hasError ? 'style="background: rgba(0,0,0,0.5);"' : '' ?>>
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header bg-light p-3">
			    <h5 class="modal-title" id="modalTitle"><?= !empty($_POST['id']) ? 'Edit' : 'Add' ?> Customer</h5>
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
                    <label>Email</label>
                    <input type="email" name="email" id="createEmail" class="form-control" value="<?= htmlspecialchars($old['email']) ?>">
                    <?php if (!empty($errors['email'])): ?><small class="text-danger"><?= $errors['email'] ?></small><?php endif; ?>
                </div>
                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" id="createPhone" class="form-control" value="<?= htmlspecialchars($old['phone']) ?>">
                    <?php if (!empty($errors['phone'])): ?><small class="text-danger"><?= $errors['phone'] ?></small><?php endif; ?>
                </div>
                <div class="mb-3">
                    <label>Address</label>
                    <textarea name="address" id="createAddress" class="form-control"><?= htmlspecialchars($old['address']) ?></textarea>
                    <?php if (!empty($errors['address'])): ?><small class="text-danger"><?= $errors['address'] ?></small><?php endif; ?>
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
                    <button class="btn btn-success" type="submit">Save Customer</button>
                    <a href="list.php" class="btn btn-secondary">Close</a>
                </div>
            </div>
        </form>
    </div>
</div>