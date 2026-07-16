<div class="page-wrapper">
    <div class="page-content">

        <div class="card radius-10">

            <div class="card-header bg-white">
                <h4 class="mb-0">
                    <i class="bx bx-group text-success"></i>
                    Layout Members
                </h4>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-light">

                            <tr>
                                <th width="60">#</th>
                                <th>Company</th>
                                <th>Member Name</th>
                                <th>Location</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th width="90">Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($members)) { ?>

                                <?php $i = 1;
                                foreach ($members as $row) { ?>

                                    <tr>

                                        <td>
                                            <?= $i++; ?>
                                        </td>

                                        <td>
                                            <?= $row->company_name; ?>
                                        </td>

                                        <td>
                                            <?= $row->member_name; ?>
                                        </td>

                                        <td>
                                            <?= $row->location; ?>
                                        </td>

                                        <td>
                                            <?= $row->email; ?>
                                        </td>

                                        <td>
                                            <?= $row->phone; ?>
                                        </td>

                                        <td>
                                            <span class="badge bg-success">
                                                <?= $row->role; ?>
                                            </span>
                                        </td>

                                        <td>

                                            <a href="<?= base_url('employee/layout_member_details/' . $row->id); ?>"
                                                class="btn btn-sm btn-info text-white">

                                                <i class="bx bx-show"></i>

                                            </a>

                                        </td>

                                    </tr>

                                <?php } ?>

                            <?php } else { ?>

                                <tr>

                                    <td colspan="8" class="text-center text-danger">
                                        No Layout Members Found
                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>
