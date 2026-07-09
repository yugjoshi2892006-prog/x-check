<div class="page-wrapper">
    <div class="page-content">
        <form method="post" action="<?= base_url('index.php/project/add_project_area') ?>">

            <input type="hidden" name="project_id" value="<?= $project_id ?>">

            <select name="floor_id" class="form-control">

                <?php foreach ($floors as $floor): ?>

                    <option value="<?= $floor->id ?>">

                        <?= $floor->floor_name ?>

                    </option>

                <?php endforeach; ?>

            </select>

            <br>

            <input type="text" name="area_name" placeholder="Area Name" class="form-control">

            <br>

            <input type="number" id="width" name="width" placeholder="Width" class="form-control">

            <br>

            <input type="number" id="length" name="length" placeholder="Length" class="form-control">

            <br>

            <input type="text" id="sqft" readonly class="form-control">

            <br>

            <button class="btn btn-success">

                Add Area

            </button>

        </form>

        <hr>

        <h4>Added Areas</h4>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Floor</th>
                    <th>Area</th>
                    <th>Width</th>
                    <th>Length</th>
                    <th>Sq.Ft</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($areas as $row): ?>

                    <tr>

                        <td><?= $row->floor_id ?></td>

                        <td><?= $row->area_name ?></td>

                        <td><?= $row->width ?></td>

                        <td><?= $row->length ?></td>

                        <td><?= $row->sq_ft ?></td>

                        <td>

                            <a href="<?= base_url('project/edit_area/' . $row->id) ?>" class="btn btn-sm btn-primary">

                                Edit

                            </a>

                            <a href="<?= base_url('project/delete_area/' . $row->id) ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete Area?')">

                                Delete

                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>
        <th>Action</th>
        <td>

            <a href="<?= base_url('project/edit_area/' . $row->id) ?>" class="btn btn-sm btn-primary">

                Edit

            </a>

            <a href="<?= base_url('project/delete_area/' . $row->id) ?>" class="btn btn-sm btn-danger"
                onclick="return confirm('Delete Area?')">

                Delete

            </a>

        </td>

        <div class="text-end mt-3">

            <a href="<?= base_url('index.php/project/edit_camera/' . $project_id) ?>" class="btn btn-primary">
                Save & Next →
            </a>
        </div>
    </div>
</div>