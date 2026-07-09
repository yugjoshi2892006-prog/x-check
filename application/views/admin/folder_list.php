<div class="page-wrapper">
    <div class="page-content">

        <style>
            .xc-wrapper {
                background: #fff;
                min-height: 100vh;
            }

            .xc-content {
                padding: 28px 32px;
            }

            .xc-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 22px;
                flex-wrap: wrap;
                gap: 12px;
            }

            .xc-header h2 {
                font-size: 22px;
                font-weight: 700;
                color: #1a1a2e;
                margin: 0;
            }

            .xc-breadcrumb {
                font-size: 12px;
                color: #9aa0ac;
                margin-bottom: 4px;
            }

            .xc-breadcrumb a {
                color: #0fb4a0;
                text-decoration: none;
            }

            .xc-breadcrumb span {
                margin: 0 5px;
            }

            /* Filter / Add card */
            .xc-filter-card {
                background: #fff;
                border: 0.5px solid #e4e6ea;
                border-radius: 12px;
                padding: 22px 24px;
                margin-bottom: 20px;
            }

            .xc-filter-card .form-label {
                font-size: 12.5px;
                font-weight: 500;
                color: #444;
                margin-bottom: 6px;
                display: block;
            }

            .xc-filter-card .form-control,
            .xc-filter-card .form-select {
                height: 42px;
                border: 1px solid #dde0e6;
                border-radius: 8px;
                font-size: 13px;
                color: #333;
                background: #fafbfc;
                padding: 0 13px;
                box-shadow: none;
                width: 100%;
                transition: border-color .15s, box-shadow .15s, background .15s;
            }

            .xc-filter-card .form-control:focus,
            .xc-filter-card .form-select:focus {
                border-color: #0fb4a0;
                box-shadow: 0 0 0 3px rgba(15, 180, 160, .12);
                background: #fff;
                outline: none;
            }

            .btn-xc-add {
                height: 42px;
                width: 100%;
                padding: 0 24px;
                background: #0fb4a0;
                color: #fff;
                border: none;
                border-radius: 8px;
                font-size: 13.5px;
                font-weight: 600;
                cursor: pointer;
                transition: background .15s;
                white-space: nowrap;
            }

            .btn-xc-add:hover {
                background: #0d9b89;
            }

            /* Table card */
            .xc-table-card {
                background: #fff;
                border: 0.5px solid #e4e6ea;
                border-radius: 12px;
                overflow: hidden;
            }

            .xc-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 13.5px;
            }

            .xc-table thead th {
                background: #0fb4a0;
                color: #fff;
                font-weight: 600;
                font-size: 12.5px;
                text-align: left;
                padding: 13px 18px;
                white-space: nowrap;
            }

            .xc-table thead th:first-child {
                border-radius: 0;
            }

            .xc-table tbody td {
                padding: 13px 18px;
                color: #333;
                border-bottom: 1px solid #f0f2f5;
                vertical-align: middle;
            }

            .xc-table tbody tr:last-child td {
                border-bottom: none;
            }

            .xc-table tbody tr:hover {
                background: #fafdfc;
            }

            .xc-folder-name {
                font-weight: 500;
                color: #1a1a2e;
            }

            .xc-empty-row td {
                text-align: center;
                color: #9aa0ac;
                padding: 32px 18px;
                font-size: 13px;
            }

            /* Status badge */
            .xc-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 5px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
            }

            .xc-badge::before {
                content: '';
                width: 6px;
                height: 6px;
                border-radius: 50%;
            }

            .xc-badge-active {
                background: #e7f8ee;
                color: #1c9a4f;
            }

            .xc-badge-active::before {
                background: #1c9a4f;
            }

            .xc-badge-inactive {
                background: #fdeeee;
                color: #d23c3c;
            }

            .xc-badge-inactive::before {
                background: #d23c3c;
            }

            /* Action buttons */
            .xc-actions {
                display: flex;
                gap: 8px;
            }

            .btn-xc-edit,
            .btn-xc-delete {
                height: 32px;
                padding: 0 16px;
                border-radius: 7px;
                font-size: 12.5px;
                font-weight: 600;
                cursor: pointer;
                border: 1px solid transparent;
                transition: background .15s, color .15s, border-color .15s;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
            }

            .btn-xc-edit {
                background: #fff;
                color: #c98a0a;
                border-color: #f3d9a3;
            }

            .btn-xc-edit:hover {
                background: #fdf6e9;
            }

            .btn-xc-delete {
                background: #fff;
                color: #d23c3c;
                border-color: #f3b9b9;
            }

            .btn-xc-delete:hover {
                background: #fdeeee;
            }

            /* Modal restyle to match brand */
            #editFolderModal .modal-content {
                border-radius: 14px;
                border: none;
                overflow: hidden;
            }

            #editFolderModal .modal-header {
                background: #0fb4a0;
                color: #fff;
                border-bottom: none;
                padding: 18px 22px;
            }

            #editFolderModal .modal-header .modal-title {
                font-size: 16px;
                font-weight: 600;
            }

            #editFolderModal .modal-header .btn-close {
                filter: brightness(0) invert(1);
                opacity: .9;
            }

            #editFolderModal .modal-body {
                padding: 22px;
            }

            #editFolderModal .form-label {
                font-size: 12.5px;
                font-weight: 500;
                color: #444;
                margin-bottom: 6px;
                display: block;
            }

            #editFolderModal .form-control,
            #editFolderModal .form-select {
                height: 42px;
                border: 1px solid #dde0e6;
                border-radius: 8px;
                font-size: 13px;
                background: #fafbfc;
            }

            #editFolderModal .form-control:focus,
            #editFolderModal .form-select:focus {
                border-color: #0fb4a0;
                box-shadow: 0 0 0 3px rgba(15, 180, 160, .12);
                background: #fff;
            }

            #editFolderModal .modal-footer {
                border-top: 1px solid #f0f2f5;
                padding: 16px 22px;
            }

            #editFolderModal .btn-primary {
                background: #0fb4a0;
                border-color: #0fb4a0;
                border-radius: 8px;
                font-size: 13.5px;
                font-weight: 500;
                padding: 9px 22px;
            }

            #editFolderModal .btn-primary:hover {
                background: #0d9b89;
                border-color: #0d9b89;
            }

            #editFolderModal .btn-secondary {
                background: #fff;
                color: #555;
                border: 1px solid #dde0e6;
                border-radius: 8px;
                font-size: 13.5px;
                font-weight: 500;
                padding: 9px 18px;
            }

            #editFolderModal .btn-secondary:hover {
                background: #f5f5f5;
                color: #333;
            }
        </style>

        <div class="xc-wrapper">
            <div class="xc-content">

                <!-- Header -->
                <div class="xc-breadcrumb">
                    <a href="<?= base_url('index.php/dashboard') ?>">Masters</a>
                    <span>›</span> Folder List
                </div>
                <div class="xc-header">
                    <h2>Folder List</h2>
                </div>

                <!-- Add Folder Form -->
                <div class="xc-filter-card">
                    <form method="post" action="<?= base_url('index.php/folder/insert') ?>">
                        <div class="row g-3">

                            <div class="col-md-5">
                                <label class="form-label">Folder Name</label>
                                <input type="text" name="folder_name" class="form-control" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn-xc-add">+ Add Folder</button>
                            </div>

                        </div>
                    </form>
                </div>

                <!-- Folder Table -->
                <div class="xc-table-card">
                    <div class="table-responsive">
                        <table class="xc-table">
                            <thead>
                                <tr>
                                    <th width="80">ID</th>
                                    <th>Folder Name</th>
                                    <th width="140">Status</th>
                                    <th width="180">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (!empty($folders)) { ?>

                                    <?php foreach ($folders as $row) { ?>

                                        <tr>

                                            <td><?= $row->id ?></td>

                                            <td class="xc-folder-name"><?= htmlspecialchars($row->folder_name) ?></td>

                                            <td>
                                                <?php if ($row->status == 'Active') { ?>
                                                    <span class="xc-badge xc-badge-active">Active</span>
                                                <?php } else { ?>
                                                    <span class="xc-badge xc-badge-inactive">Inactive</span>
                                                <?php } ?>
                                            </td>

                                            <td>
                                                <div class="xc-actions">

                                                    <button type="button" class="btn-xc-edit editFolderBtn"
                                                        data-id="<?= $row->id ?>"
                                                        data-name="<?= htmlspecialchars($row->folder_name) ?>"
                                                        data-status="<?= $row->status ?>">
                                                        Edit
                                                    </button>

                                                    <a href="<?= base_url('index.php/folder/delete/' . $row->id) ?>"
                                                        class="btn-xc-delete" onclick="return confirm('Delete Folder?')">
                                                        Delete
                                                    </a>

                                                </div>
                                            </td>

                                        </tr>

                                    <?php } ?>

                                <?php } else { ?>

                                    <tr class="xc-empty-row">
                                        <td colspan="4">No Folder Found</td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


<!-- Edit Folder Modal -->

<div class="modal fade" id="editFolderModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form id="editFolderForm" method="post">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Edit Folder
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Folder Name</label>
                        <input type="text" name="folder_name" id="folder_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="folder_status" class="form-select">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">
                        Update Folder
                    </button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

    $(document).ready(function () {

        $('.editFolderBtn').click(function () {

            var id = $(this).data('id');
            var name = $(this).data('name');
            var status = $(this).data('status');

            $('#folder_name').val(name);
            $('#folder_status').val(status);

            $('#editFolderForm').attr(
                'action',
                '<?= base_url("index.php/folder/update/") ?>' + id
            );

            var myModal = new bootstrap.Modal(
                document.getElementById('editFolderModal')
            );

            myModal.show();

        });

    });

</script>