<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-body">

                <h4>Attendance List</h4>

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($attendance as $row) { ?>

                            <tr>
                                <td><?= $row->attendance_date ?></td>
                                <td><?= $row->check_in_time ?></td>
                                <td><?= $row->status ?></td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>
        </div>

    </div>
</div>