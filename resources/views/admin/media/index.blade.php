@extends('layouts.admin')

@section('title', 'Media Library')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Media Library</h4>
                {{-- Upload Form --}}
                <form id="upload-form" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                    @csrf
                    <div class="d-flex flex-column me-2">
                        <input type="file" name="files[]" id="file-input" class="form-control" required multiple>
                        <small class="text-muted mt-1" style="font-size: 0.7rem;">Max size: 2MB per file</small>
                    </div>
                    <button type="submit" class="btn btn-primary h-100" id="btn-upload">Upload</button>
                    <div id="upload-spinner" class="ms-2" style="display:none;">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div id="alert-container">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- Bulk Action Bar --}}
                <div class="mb-3" style="display:none;" id="bulk-action-bar">
                    <button type="button" class="btn btn-danger btn-sm" id="btn-bulk-delete">Delete Selected</button>
                </div>

                <div id="media-grid-container">
                    @include('admin.media.partials.media-grid')
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const uploadForm = document.getElementById('upload-form');
                        const fileInput = document.getElementById('file-input');
                        const btnUpload = document.getElementById('btn-upload');
                        const uploadSpinner = document.getElementById('upload-spinner');
                        const gridContainer = document.getElementById('media-grid-container');
                        const alertContainer = document.getElementById('alert-container');
                        const bulkActionBar = document.getElementById('bulk-action-bar');
                        const btnBulkDelete = document.getElementById('btn-bulk-delete');

                        function showAlert(type, message) {
                            alertContainer.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
                            setTimeout(() => alertContainer.innerHTML = '', 5000);
                        }

                        // File Size Validation
                        fileInput.addEventListener('change', function() {
                            const maxFileSize = 2 * 1024 * 1024; // 2MB
                            let hasLargeFile = false;
                            for (let i = 0; i < this.files.length; i++) {
                                if (this.files[i].size > maxFileSize) {
                                    hasLargeFile = true;
                                    break;
                                }
                            }
                            if (hasLargeFile) {
                                alert('One or more files exceed the 2MB limit.');
                                this.value = '';
                            }
                        });


                        // AJAX Upload
                        uploadForm.addEventListener('submit', function(e) {
                            e.preventDefault();
                            
                            const formData = new FormData(this);
                            btnUpload.disabled = true;
                            uploadSpinner.style.display = 'block';

                            fetch('{{ route("admin.media.store") }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    gridContainer.innerHTML = data.html;
                                    fileInput.value = '';
                                    showAlert('success', data.message);
                                    rebindEvents();
                                } else {
                                    showAlert('danger', 'Upload failed.');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showAlert('danger', 'An error occurred during upload.');
                            })
                            .finally(() => {
                                btnUpload.disabled = false;
                                uploadSpinner.style.display = 'none';
                            });
                        });

                        // AJAX Pagination
                        function handlePagination(e) {
                            if (e.target.tagName === 'A' || e.target.parentElement.tagName === 'A') {
                                e.preventDefault();
                                const url = (e.target.tagName === 'A' ? e.target.href : e.target.parentElement.href);
                                
                                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                                .then(response => response.text())
                                .then(html => {
                                    gridContainer.innerHTML = html;
                                    rebindEvents();
                                });
                            }
                        }

                        // AJAX Individual Delete
                        function handleDelete(e) {
                            if (e.target.classList.contains('btn-delete-media')) {
                                if (!confirm('Are you sure?')) return;

                                const btn = e.target;
                                const url = btn.dataset.url;
                                const itemCard = document.getElementById(`media-item-${btn.dataset.id}`);

                                fetch(url, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        itemCard.remove();
                                        showAlert('success', data.message);
                                        rebindEvents(); // Re-check checkboxes
                                    }
                                });
                            }
                        }

                        // Toggle Bulk Bar
                        function toggleActionBar() {
                            const checked = document.querySelectorAll('.media-checkbox:checked').length;
                            bulkActionBar.style.display = checked > 0 ? 'block' : 'none';
                        }

                        // AJAX Bulk Delete
                        btnBulkDelete.addEventListener('click', function() {
                            if (!confirm('Delete selected items?')) return;

                            const checkedIds = Array.from(document.querySelectorAll('.media-checkbox:checked')).map(cb => cb.value);
                            
                            fetch('{{ route("admin.media.bulk-delete") }}', {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify({ ids: checkedIds })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Remove deleted items from UI
                                    checkedIds.forEach(id => {
                                        const el = document.getElementById(`media-item-${id}`);
                                        if (el) el.remove();
                                    });
                                    toggleActionBar();
                                    showAlert('success', data.message);
                                }
                            });
                        });

                        function rebindEvents() {
                            const checkboxes = document.querySelectorAll('.media-checkbox');
                            checkboxes.forEach(cb => cb.addEventListener('change', toggleActionBar));
                            toggleActionBar(); // Check state
                            
                            // Re-attach pagination listeners
                            const paginationLinks = gridContainer.querySelectorAll('.pagination a');
                            paginationLinks.forEach(link => link.addEventListener('click', handlePagination));

                            // Re-attach delete listeners
                            const deleteBtns = gridContainer.querySelectorAll('.btn-delete-media');
                            deleteBtns.forEach(btn => btn.addEventListener('click', handleDelete));
                        }

                        rebindEvents(); // Initial bind
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
