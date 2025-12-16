<!-- Modal for Adding New Actor -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addItemForm">
                    @csrf
                    <div id="form-content"></div>

                    <div id="modalError" class="text-danger d-none mt-2"></div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Add and Select</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
