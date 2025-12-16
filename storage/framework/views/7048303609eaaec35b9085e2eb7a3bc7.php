<!-- jQuery -->
<script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>

<!-- overlayScrollbars -->
<script src="<?php echo e(asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('dist/js/adminlte.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/toastr/toastr.min.js')); ?>"></script>
<?php if(isset($selector)): ?>
    <script>
        const maxFileSize = <?php echo e($maxFileSizeInMB ?? 50); ?>;
        const fileUploadRoute = "<?php echo e(route('uploads.store.ajax')); ?>";

        const myDropzone = new Dropzone("#fileDropzone", {
            url: fileUploadRoute,
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
            },
            paramName: "file",
            maxFilesize: maxFileSize,
            addRemoveLinks: true,
            acceptedFiles: "image/*,application/pdf",
            dictDefaultMessage: "Drag & Drop files here or click to select",
            dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
            dictInvalidFileType: "This file type is not allowed.",

            dictCancelUpload: "Cancel upload",
            dictRemoveFile: "Remove file",
            init: function() {
                this.on("addedfile", function(file) {});

                this.on("success", function(file, response) {
                    fetchFiles();
                });

                this.on("error", function(file, errorMessage) {
                    console.error("Error uploading file: " + errorMessage);
                });
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const fileGrid = document.getElementById('fileGrid');
            const uploadForm = document.getElementById('uploadFileForm');
            const uploadFeedback = document.getElementById('uploadFeedback');
            const paginationContainer = document.getElementById('paginationContainer');
            const selectFilesButton = document.getElementById('selectFilesButton');

            const fileSearchInput = document.getElementById('fileSearchInput');
            let searchQuery = '';

            // Update search query on input
            fileSearchInput.addEventListener('input', function() {
                searchQuery = this.value.trim();
                fetchFiles(1);
            });

            // Store file IDs for submission and file names for UI display
            let selectedFileIds = {
                single: null,
                multiple: new Set()
            };

            let selectedFileNames = {
                single: null,
                multiple: new Set()
            };

            let isMultipleSelection = true;
            let dynamicInputName = '';
            let targetForm = null;

            // Clear feedback message when switching tabs
            $('#fileTabs a').on('click', function() {
                if (Dropzone.instances.length > 0) {
                    Dropzone.instances[0].removeAllFiles(true);
                }
            });

            // Function to update the UI with the selected file names
            const updateSelectedFilesUI = () => {
                if (!targetForm) return;

                const singleFileNames = targetForm.querySelector('.single-file-names');
                const multipleFileNames = targetForm.querySelector('.multiple-file-names');

                if (isMultipleSelection && multipleFileNames) {
                    if (selectedFileNames.multiple.size > 0) {
                        multipleFileNames.textContent = Array.from(selectedFileNames.multiple).join(', ');
                    } else {
                        multipleFileNames.textContent = 'No files selected.';
                    }
                } else if (!isMultipleSelection && singleFileNames) {
                    singleFileNames.textContent = selectedFileNames.single ?
                        selectedFileNames.single :
                        'No file selected.';
                }
            };

            // Fetch files and populate the grid
            window.fetchFiles = async function fetchFiles(page = 1) {
                const response = await fetch(
                    `<?php echo e(route('uploads.list')); ?>?page=${page}&search=${encodeURIComponent(searchQuery)}`
                );
                const data = await response.json();
                const files = data.data;

                fileGrid.innerHTML = '';
                paginationContainer.innerHTML = '';

                files.forEach(file => {
                    const fileCard = document.createElement('div');
                    fileCard.classList.add('col-lg-3', 'file-item');
                    fileCard.innerHTML = `
                    <div class="card text-center">
                        <label for="file-${file.id}" class="file-image-label">
                            <img src="${file.url}" alt="${file.file_name}" class="card-img-top img-thumbnail" style="height: 80px; object-fit: cover;">
                        </label>
                        <div class="card-body p-1">
                            <h6 class="card-title text-truncate" title="${file.file_name.length > 25 ? file.file_name.slice(0, 25) + '…' : file.file_name}">${file.file_name.length > 25 ? file.file_name.slice(0, 25) + '…' : file.file_name}</h6> <br>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input file-selector" id="file-${file.id}" data-id="${file.id}" data-name="${file.file_name}">
                                <label class="form-check-label" for="file-${file.id}">Select</label>
                            </div>
                        </div>
                    </div>
                `;
                    fileGrid.appendChild(fileCard);
                });

                // Pagination handling
                if (data.links) {
                    paginationContainer.innerHTML = '';
                    const paginationWrapper = document.createElement('div');
                    paginationWrapper.classList.add('d-flex', 'justify-content-center', 'flex-wrap',
                        'gap-1');

                    data.links.forEach(link => {
                        const pageLink = document.createElement('button');
                        pageLink.classList.add('btn', 'btn-outline-primary', 'page-link', 'mx-1');
                        pageLink.innerHTML = link.label;
                        pageLink.disabled = !link.url;
                        pageLink.style.minWidth = '40px';

                        if (link.url) {
                            pageLink.addEventListener('click', () => fetchFiles(link.url.split(
                                'page=')[
                                1]));
                        }
                        paginationWrapper.appendChild(pageLink);
                    });

                    paginationContainer.appendChild(paginationWrapper);
                }
            }

            // Handle single and multiple selection logic
            fileGrid.addEventListener('change', (event) => {
                const checkbox = event.target;
                if (checkbox.classList.contains('file-selector')) {
                    const fileId = checkbox.dataset.id;
                    const fileName = checkbox.dataset.name;

                    if (!isMultipleSelection) {
                        selectedFileIds.single = checkbox.checked ? fileId : null;
                        selectedFileNames.single = checkbox.checked ? fileName : null;

                        document.querySelectorAll('.file-selector').forEach(input => {
                            if (input !== checkbox) input.checked = false;
                        });
                    } else {
                        if (checkbox.checked) {
                            selectedFileIds.multiple.add(fileId);
                            selectedFileNames.multiple.add(fileName);
                        } else {
                            selectedFileIds.multiple.delete(fileId);
                            selectedFileNames.multiple.delete(fileName);
                        }
                    }

                    updateSelectedFilesUI();
                }
            });

            // Configure modal behavior
            $('#fileSelectorModal').on('show.bs.modal', function(event) {
                const triggerElement = event.relatedTarget;
                const modalTitle = triggerElement.getAttribute('data-title');
                const modalLabel = document.getElementById('fileSelectorModalLabel');

                isMultipleSelection = triggerElement.getAttribute('data-selection-type') === 'multiple';
                dynamicInputName = triggerElement.getAttribute('data-input-name');
                targetForm = triggerElement.closest(
                    '.file-selector-container');

                if (modalLabel && modalTitle) {
                    modalLabel.textContent = modalTitle;
                }
                selectedFileIds = {
                    single: null,
                    multiple: new Set()
                };
                selectedFileNames = {
                    single: null,
                    multiple: new Set()
                };
                updateSelectedFilesUI();
                fetchFiles(1);
            });

            // Handle file selection confirmation
            selectFilesButton.addEventListener('click', function() {
                if (!targetForm) return;

                // Check if any files are selected
                if (isMultipleSelection && selectedFileIds.multiple.size === 0) {
                    alert("Please select at least one file.");
                    return;
                }

                if (!isMultipleSelection && !selectedFileIds.single) {
                    alert("Please select a file.");
                    return;
                }

                // Remove existing hidden inputs with the same name
                targetForm.querySelectorAll(`input[name="${dynamicInputName}"]`).forEach(input => input
                    .remove());

                // Add new hidden inputs for file IDs
                if (isMultipleSelection) {
                    selectedFileIds.multiple.forEach(fileId => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = dynamicInputName;
                        input.value = fileId;
                        targetForm.appendChild(input);
                    });
                } else if (selectedFileIds.single) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = dynamicInputName;
                    input.value = selectedFileIds.single;
                    targetForm.appendChild(input);
                }

                // Close modal after selecting files
                $('#fileSelectorModal').modal('hide');
            });
        });
    </script>
<?php endif; ?>
<?php if(isset($addModal)): ?>
    <script>
        $(document).ready(function() {
            $('#addModal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var url = button.data('url');
                var type = button.data('type');

                // Set form attributes
                $('#addItemForm').attr('action', url);
                $('#addItemForm').data('type', type);

                // Dynamic form content based on type
                var formContent = '';
                switch (type) {
                    case 'language':
                        formContent = `
                        <div class="form-group">
                            <label for="language_name">Language Name</label>
                            <input type="text" name="name" id="language_name" class="form-control" required>
                        </div>`;
                        break;

                    case 'category':
                        formContent = `
                        <div class="form-group">
                            <label for="category_title">Category Name</label>
                            <input type="text" name="title" id="category_title" class="form-control" required>
                        </div>`;
                        break;

                    default:
                        formContent = `<p class="text-danger">Invalid type selected. Please try again.</p>`;
                }

                // Update modal content
                $('#form-content').html(formContent);
                $('#modalError').addClass('d-none').text('');
            });

            // Submit form via AJAX
            $('#addItemForm').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var url = form.attr('action');
                var type = form.data('type');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#addModal').modal('hide');
                            var model = response[type];

                            if (model) {
                                var dropdownId = `#${type}_id`;
                                var newOption = new Option(model.title, model.id, false, false);
                                $(dropdownId).append(newOption).val(model.id).trigger('change');
                            }

                            form[0].reset();
                        } else {
                            $('#modalError').removeClass('d-none').text(response.message ||
                                'Something went wrong!');
                        }
                    },
                    error: function(xhr) {
                        $('#modalError').removeClass('d-none').text(
                            'An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
<?php endif; ?>

<?php if(isset($slug)): ?>
    <script>
        function generateSlug(input, output) {
            let text = input.value.trim();

            // Bangla → English map (common phonetics)
            const bnMap = {
                'অ': 'o',
                'আ': 'a',
                'ই': 'i',
                'ঈ': 'i',
                'উ': 'u',
                'ঊ': 'u',
                'এ': 'e',
                'ঐ': 'oi',
                'ও': 'o',
                'ঔ': 'ou',
                'ক': 'k',
                'খ': 'kh',
                'গ': 'g',
                'ঘ': 'gh',
                'ঙ': 'ng',
                'চ': 'ch',
                'ছ': 'ch',
                'জ': 'j',
                'ঝ': 'jh',
                'ঞ': 'n',
                'ট': 't',
                'ঠ': 'th',
                'ড': 'd',
                'ঢ': 'dh',
                'ণ': 'n',
                'ত': 't',
                'থ': 'th',
                'দ': 'd',
                'ধ': 'dh',
                'ন': 'n',
                'প': 'p',
                'ফ': 'f',
                'ব': 'b',
                'ভ': 'bh',
                'ম': 'm',
                'য': 'j',
                'র': 'r',
                'ল': 'l',
                'শ': 'sh',
                'ষ': 'sh',
                'স': 's',
                'হ': 'h',
                'য়': 'y',
                'ড়': 'r',
                'ঢ়': 'rh',
                'ৎ': 't',
                'া': 'a',
                'ি': 'i',
                'ী': 'i',
                'ু': 'u',
                'ূ': 'u',
                'ে': 'e',
                'ৈ': 'oi',
                'ো': 'o',
                'ৌ': 'ou',
                '্': '',
                'ঁ': '',
                'ং': 'ng',
                'ঃ': 'h'
            };

            // Transliterate Bangla → English
            let converted = '';
            for (let char of text) {
                converted += bnMap[char] ?? char;
            }

            // Create slug
            let slug = converted.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');

            output.value = slug;
        }
    </script>
<?php endif; ?>
<script>
    // Toastr options
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": 500,
        "hideDuration": 1000,
        "timeOut": 2000,
        "extendedTimeOut": 0,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // Handle session-based toastr notifications
    <?php if(Session::has('success')): ?>
        let successData = <?php echo json_encode(Session::get('success'), 15, 512) ?>;
        toastr.success(successData.message, successData.title);
    <?php endif; ?>

    <?php if(Session::has('warning')): ?>
        let warningData = <?php echo json_encode(Session::get('warning'), 15, 512) ?>;
        toastr.warning(warningData.message, warningData.title);
    <?php endif; ?>

    <?php if(Session::has('error')): ?>
        let errorData = <?php echo json_encode(Session::get('error'), 15, 512) ?>;
        toastr.error(errorData.message, errorData.title);
    <?php endif; ?>

    <?php if(Session::has('info')): ?>
        let infoData = <?php echo json_encode(Session::get('info'), 15, 512) ?>;
        toastr.info(infoData.message, infoData.title);
    <?php endif; ?>


    // Function to handle AJAX toastr notifications
    function notifyToastr(type, title, message) {
        if (type === 'success') {
            toastr.success(message, title);
        } else if (type === 'warning') {
            toastr.warning(message, title);
        } else if (type === 'error') {
            toastr.error(message, title);
        } else if (type === 'info') {
            toastr.info(message, title);
        } else {
            console.error('Unknown toastr type: ' + type);
        }
    }
</script>
<?php /**PATH /var/www/html/Njobs/resources/views/admin/layouts/partials/asset/_script.blade.php ENDPATH**/ ?>