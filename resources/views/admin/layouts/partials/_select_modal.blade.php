<!-- File Selector Modal -->
<div class="modal fade" id="fileSelectorModal" tabindex="-1" role="dialog" aria-labelledby="fileSelectorModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileSelectorModalLabel">Select Files</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="fileSearchInput" class="form-control" placeholder="Search files by name...">
                </div>
                <ul class="nav nav-tabs" id="fileTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="uploaded-files-tab" data-toggle="tab" href="#uploadedFiles" role="tab" aria-controls="uploadedFiles" aria-selected="true">All Uploaded Files</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="upload-file-tab" data-toggle="tab" href="#uploadFile" role="tab" aria-controls="uploadFile" aria-selected="false">Upload New File</a>
                    </li>
                </ul>

                <div class="tab-content mt-1">
                    <div class="tab-pane fade show active" id="uploadedFiles" role="tabpanel" aria-labelledby="uploaded-files-tab">
                        <div class="row" id="fileGrid">
                        </div>
                        <div class="mt-1 text-center" id="paginationContainer">
                        </div>
                    </div>

                    <div class="tab-pane fade" id="uploadFile" role="tabpanel" aria-labelledby="upload-file-tab">
                        <form class="p-1 rounded shadow-sm bg-light" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="fileInput" class="form-label">Select File:</label>
                                <div id="fileDropzone" class="dropzone mb-2">
                                    <div class="dz-message">Drag & Drop files here or click to select</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="selectFilesButton">Select Files</button>
            </div>
        </div>
    </div>
</div>
{{-- <div class="file-selector-container col-lg-8">
    <div class="file-selector-item single-selector col-lg-6" 
        data-toggle="modal" 
        data-target="#fileSelectorModal" 
        data-selection-type="single" 
        data-input-name="image_url" 
        data-title="Select Category Image">
        <i class="fa fa-file"></i>
        <span>Select Category Image</span>
        <div class="selected-files single-file-names mt-2 text-muted"></div>
    </div>
</div>
<div class="file-selector-container col-lg-8">
    <div class="file-selector-item multiple-selector col-lg-6" 
        data-toggle="modal" 
        data-target="#fileSelectorModal" 
        data-selection-type="multiple" 
        data-input-name="image_url" 
        data-title="Select Category Image">
        <i class="fa fa-file"></i>
        <span>Select Category Image</span>
        <div class="selected-files multiple-file-names mt-2 text-muted"></div>
    </div>
</div> --}}