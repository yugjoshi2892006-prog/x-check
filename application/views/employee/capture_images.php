<div class="page-wrapper">
    <div class="page-content">

        <div class="card p-4">
            <h3><?= $project->project_name ?></h3>

            <!-- <div class="alert alert-info mt-2">
                <strong>Current Monitoring Cycle :</strong>
                <?= $current_cycle->cycle_no ?>
            </div>
            <a href="<?= site_url('employee/start_monitoring/' . $project->id) ?>" class="btn btn-primary mb-3">
                Start New Monitoring
            </a> -->

            <?php if (!empty($floors)): ?>
                <?php $floor = $floors[0]; ?>

                <div style="position:relative; display:inline-block;">

                    <img src="<?= base_url('uploads/floor_plan/' . $floor->floor_image); ?>"
                        style="max-width:100%;border:1px solid #ddd;">

                    <?php foreach ($cameras as $cam): ?>

                        <?php if ($cam->floor_id == $floor->id): ?>

                            <?php
                            $preview = '';

                            if (
                                isset($last_images) &&
                                isset($last_images[$cam->id])
                            ) {
                                $preview = $last_images[$cam->id];
                            }
                            ?>

                            <div onclick="openModal(<?= $cam->id ?>)" style="
                                    position:absolute;
                                    left:<?= $cam->x_position ?>px;
                                    top:<?= $cam->y_position ?>px;
                                    cursor:pointer;
                                    z-index:9999;
                                ">

                                <img src="<?= base_url('assets/camera.png') ?>" width="40">

                                <div style="
                                    background:#00b8b8;
                                    color:#fff;
                                    padding:2px 8px;
                                    border-radius:10px;
                                    font-size:11px;
                                    text-align:center;">
                                    CAM-<?= $cam->camera_no ?>
                                </div>

                                <?php if ($preview != ''): ?>

                                    <img src="<?= base_url('uploads/floor_plan/project_image/' . $preview) ?>" style="
                                            width:80px;
                                            height:60px;
                                            object-fit:cover;
                                            border:2px solid #fff;
                                            border-radius:5px;
                                            margin-top:5px;
                                            display:block;
                                        ">

                                <?php endif; ?>

                            </div>

                        <?php endif; ?>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="<?= site_url('employee/save_capture') ?>" method="post" enctype="multipart/form-data">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Capture Image
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="project_id" value="<?= $project->id ?>">

                    <input type="hidden" name="camera_id" id="camera_id">

                    <div class="mb-3">
                        <label>Upload Image</label>

                        <input type="file" name="image" id="image" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Remarks</label>

                        <textarea name="remarks" class="form-control"></textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="submit" class="btn btn-success">
                        Upload
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<script>
    function openModal(camera_id) {
        document.getElementById('camera_id').value = camera_id;

        let modal = new bootstrap.Modal(
            document.getElementById('uploadModal')
        );

        modal.show();
    }
</script>
```