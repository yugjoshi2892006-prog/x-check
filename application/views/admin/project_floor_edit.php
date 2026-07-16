<div class="page-wrapper">
    <div class="page-content">
        <div class="container mt-4">

            <h3>Step 2 : Floors</h3>

            <form method="post" enctype="multipart/form-data" action="<?= base_url('project/add_project_floor') ?>">

                <input type="hidden" name="project_id" value="<?= $project_id ?>">

                <div class="mb-3">

                    <label>Floor Name</label>

                    <input type="text" name="floor_name" class="form-control">

                </div>

                <div class="mb-3">

                    <label>Floor Plan</label>

                    <input type="file" name="floor_plan" class="form-control">

                </div>

                <button class="btn btn-primary">

                    Add Floor

                </button>

            </form>

            <hr>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Floor Name</th>
                        <th>Floor Plan</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($floors as $floor): ?>

                        <tr>

                            <td>
                                <?= $floor->floor_name ?>
                            </td>

                            <td>

                                <?php if ($floor->floor_image != '') { ?>

                                    <img src="<?= base_url('uploads/floor_plan/' . $floor->floor_image) ?>" width="120">

                                <?php } ?>

                            </td>

                            <td>

                                <a href="<?= base_url('project/edit_floor/' . $floor->id) ?>"
                                    class="btn btn-sm btn-primary">

                                    Edit

                                </a>

                                <a href="<?= base_url('project/delete_project_floor/' . $floor->id) ?>"
                                    class="btn btn-sm btn-danger" onclick="return confirm('Delete Floor?')">

                                    Delete

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

            <br>

            <a href="<?= base_url('project/edit_areas/' . $project_id) ?>" class="btn btn-success">

                Next →

            </a>

        </div>
    </div>
</div>
