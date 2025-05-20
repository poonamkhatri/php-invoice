<!-- Delete Confirmation Modal (Styled like the screenshot) -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
    	<div class="modal-content text-center p-4 border-0 shadow-lg rounded-4">
    		<button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
      		<div class="modal-body">
				<div class="mb-3">
					<i class="mdi mdi-delete-circle" style="font-size: 4rem; color: #f44336;"></i>
				</div>
        		<h4 class="mb-2 fw-bold">Are you sure?</h4>
        		<p class="text-muted">Do you really want to delete these records? This process cannot be undone.</p>
      		</div>
			<div class="modal-footer justify-content-center border-0">
				<button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
				<a href="#" id="confirmDeleteBtn" class="btn btn-danger px-4">Delete</a>
			</div>
    	</div>
  	</div>
</div>
