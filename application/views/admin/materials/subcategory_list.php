<style>
    .xc-msc-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(26, 26, 46, 0.08);
    }

    .xc-msc-card .card-body {
        padding: 24px;
    }

    .xc-msc-title {
        color: #1a1a2e;
        font-weight: 700;
        margin-bottom: 18px !important;
    }

    /* Form */
    .xc-msc-form .form-control {
        border: 1px solid #dfe3e8;
        border-radius: 8px;
        height: 42px;
        font-size: 14px;
        color: #1a1a2e;
    }

    .xc-msc-form .form-control:focus {
        border-color: #0fb4a0;
        box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.15);
    }

    .xc-msc-form select.form-control {
        cursor: pointer;
    }

    .xc-msc-btn-add {
        background-color: #0fb4a0;
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        height: 42px;
        transition: background-color 0.2s ease;
    }

    .xc-msc-btn-add:hover {
        background-color: #0c9786;
        color: #fff;
    }

    .xc-msc-hr {
        border-top: 1px solid #eef0f3;
        margin: 8px 0 20px 0;
    }

    /* Table */
    .xc-msc-table-wrap {
        overflow-x: auto;
        border-radius: 10px;
        border: 1px solid #eef0f3;
    }

    .xc-msc-table {
        margin-bottom: 0;
    }

    /* IMPORTANT: do not pair with Bootstrap's .table-light on the <thead> markup below —
       that class injects its own background-color/color rules that fight with this
       gradient + white-text styling and is what was washing out the header text. */
    .xc-msc-table thead,
    .xc-msc-table thead tr {
        background: linear-gradient(90deg, #0fb4a0, #0c9786) !important;
        background-color: #0fb4a0 !important;
    }

    .xc-msc-table thead th {
        color: #ffffff !important;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        border: none !important;
        padding: 12px 16px;
        white-space: nowrap;
        background: transparent !important;
    }

    .xc-msc-table tbody td {
        padding: 12px 16px;
        font-size: 14px;
        color: #1a1a2e;
        vertical-align: middle;
        border-color: #eef0f3;
    }

    .xc-msc-table tbody tr:hover {
        background-color: #f6fcfb;
    }

    .xc-msc-empty {
        padding: 30px 0;
        color: #8a8f98;
        font-size: 14px;
    }

    .xc-msc-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        background-color: rgba(15, 180, 160, 0.12);
        color: #0c9786;
        font-size: 12.5px;
        font-weight: 600;
    }

    /* Pagination */
    .xc-msc-pagination-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 18px;
    }

    .xc-msc-pagination-info {
        font-size: 13px;
        color: #8a8f98;
        white-space: nowrap;
    }

    .xc-msc-pagination {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .xc-msc-pagination li {
        display: inline-block;
    }

    .xc-msc-page-btn {
        border: 1px solid #dfe3e8;
        background-color: #fff;
        color: #1a1a2e;
        min-width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.15s ease;
        padding: 0 10px;
    }

    .xc-msc-page-btn:hover:not(:disabled) {
        border-color: #0fb4a0;
        color: #0fb4a0;
    }

    .xc-msc-page-btn.active {
        background-color: #0fb4a0;
        border-color: #0fb4a0;
        color: #fff;
    }

    .xc-msc-page-btn:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

    .xc-msc-page-dots {
        min-width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        color: #8a8f98;
    }

    @media (max-width: 600px) {
        .xc-msc-card .card-body {
            padding: 16px;
        }

        .xc-msc-pagination-wrap {
            justify-content: center;
            text-align: center;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">

        <div class="card xc-msc-card">
            <div class="card-body">

                <h4 class="xc-msc-title">Material Sub Categories</h4>

                <form class="xc-msc-form" action="<?= site_url('materials/add_subcategory'); ?>" method="POST">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <select class="form-control" name="category_id" required>
                                <option value="">Select Category</option>

                                <?php foreach ($categories as $cat) { ?>

                                    <option value="<?= $cat->id; ?>">
                                        <?= $cat->category_name; ?>
                                    </option>

                                <?php } ?>

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="subcategory_name"
                                placeholder="Enter Sub Category" required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <button type="submit" class="btn xc-msc-btn-add w-100">
                                Add
                            </button>
                        </div>

                    </div>

                </form>

                <hr class="xc-msc-hr">

                <div class="xc-msc-table-wrap">
                    <table class="table table-bordered xc-msc-table" id="xcMscTable">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                            </tr>
                        </thead>

                        <tbody id="xcMscTbody">

                            <?php if (!empty($subcategories)) { ?>

                                <?php $i = 1;
                                foreach ($subcategories as $row) { ?>

                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><span class="xc-msc-badge"><?= $row->category_name; ?></span></td>
                                        <td><?= $row->subcategory_name; ?></td>
                                    </tr>

                                <?php } ?>

                            <?php } else { ?>

                                <tr>
                                    <td colspan="3" class="text-center xc-msc-empty">
                                        No Data Found
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>
                </div>

                <?php if (!empty($subcategories)) { ?>
                    <div class="xc-msc-pagination-wrap" id="xcMscPaginationWrap">
                        <div class="xc-msc-pagination-info" id="xcMscInfo"></div>
                        <ul class="xc-msc-pagination" id="xcMscPagination"></ul>
                    </div>
                <?php } ?>

            </div>
        </div>

    </div>
</div>

<?php if (!empty($subcategories)) { ?>
    <script>
        (function () {
            var rowsPerPage = 30; // 30 rows per page
            var maxVisibleButtons = 7; // how many numbered buttons to show before collapsing with "..."
            var tbody = document.getElementById('xcMscTbody');
            var allRows = Array.prototype.slice.call(tbody.querySelectorAll('tr'));
            var pagination = document.getElementById('xcMscPagination');
            var info = document.getElementById('xcMscInfo');
            var totalRows = allRows.length;
            var totalPages = Math.ceil(totalRows / rowsPerPage);
            var currentPage = 1;

            function renderTable(page) {
                if (page < 1 || page > totalPages) return;
                currentPage = page;
                var start = (page - 1) * rowsPerPage;
                var end = start + rowsPerPage;

                allRows.forEach(function (row, idx) {
                    row.style.display = (idx >= start && idx < end) ? '' : 'none';
                });

                info.textContent = 'Showing ' + (start + 1) + '-' + Math.min(end, totalRows) + ' of ' + totalRows + ' entries';
                renderPagination();
            }

            function makePageBtn(label, page, opts) {
                opts = opts || {};
                var li = document.createElement('li');
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'xc-msc-page-btn' + (opts.active ? ' active' : '');
                btn.innerHTML = label;
                if (opts.disabled) btn.disabled = true;
                btn.addEventListener('click', function () { renderTable(page); });
                li.appendChild(btn);
                return li;
            }

            function makeDots() {
                var li = document.createElement('li');
                var span = document.createElement('span');
                span.className = 'xc-msc-page-dots';
                span.textContent = '...';
                li.appendChild(span);
                return li;
            }

            function getPageList() {
                // Builds a windowed list of page numbers around the current page,
                // always keeping first and last page visible, e.g. 1 ... 4 5 [6] 7 8 ... 33
                var pages = [];
                if (totalPages <= maxVisibleButtons) {
                    for (var p = 1; p <= totalPages; p++) pages.push(p);
                    return pages;
                }

                var side = 2; // pages to show on each side of current
                var left = Math.max(2, currentPage - side);
                var right = Math.min(totalPages - 1, currentPage + side);

                pages.push(1);
                if (left > 2) pages.push('...');
                for (var p = left; p <= right; p++) pages.push(p);
                if (right < totalPages - 1) pages.push('...');
                pages.push(totalPages);

                return pages;
            }

            function renderPagination() {
                pagination.innerHTML = '';

                pagination.appendChild(
                    makePageBtn('&laquo;', currentPage - 1, { disabled: currentPage === 1 })
                );

                var pageList = getPageList();
                pageList.forEach(function (p) {
                    if (p === '...') {
                        pagination.appendChild(makeDots());
                    } else {
                        pagination.appendChild(
                            makePageBtn(p, p, { active: p === currentPage })
                        );
                    }
                });

                pagination.appendChild(
                    makePageBtn('&raquo;', currentPage + 1, { disabled: currentPage === totalPages })
                );
            }

            if (totalRows > 0) {
                renderTable(1);
            }
        })();
    </script>
<?php } ?>