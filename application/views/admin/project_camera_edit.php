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
                margin-bottom: 4px;
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
                margin-bottom: 24px;
            }

            .xc-breadcrumb a {
                color: #0fb4a0;
                text-decoration: none;
            }

            .xc-breadcrumb span {
                margin: 0 5px;
            }

            /* Wizard */
            .xc-wizard {
                display: flex;
                align-items: center;
                margin-bottom: 28px;
            }

            .xc-wizard-step {
                display: flex;
                align-items: center;
                gap: 10px;
                flex: 1;
            }

            .xc-wizard-step:last-child {
                flex: none;
            }

            .xc-wizard-step .step-circle {
                width: 34px;
                height: 34px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 13px;
                font-weight: 600;
                flex-shrink: 0;
                border: 2px solid #dde0e6;
                background: #fff;
                color: #9aa0ac;
            }

            .xc-wizard-step.done .step-circle {
                background: #e0f7f4;
                border-color: #0fb4a0;
                color: #0fb4a0;
            }

            .xc-wizard-step.active .step-circle {
                background: #0fb4a0;
                border-color: #0fb4a0;
                color: #fff;
            }

            .xc-wizard-step .step-label {
                font-size: 12px;
                font-weight: 500;
                color: #9aa0ac;
            }

            .xc-wizard-step.done .step-label {
                color: #0fb4a0;
            }

            .xc-wizard-step.active .step-label {
                color: #0fb4a0;
                font-weight: 600;
            }

            .xc-wizard-connector {
                flex: 1;
                height: 2px;
                background: #dde0e6;
                margin: 0 8px;
            }

            .xc-wizard-connector.done {
                background: #0fb4a0;
            }

            /* Form card */
            .xc-form-card {
                background: #fff;
                border: 0.5px solid #e4e6ea;
                border-radius: 12px;
                padding: 24px 24px 20px;
                margin-bottom: 20px;
            }

            .xc-section-label {
                font-size: 11px;
                font-weight: 600;
                letter-spacing: .06em;
                text-transform: uppercase;
                color: #9aa0ac;
                margin-bottom: 16px;
            }

            /* Toolbar */
            .xc-cam-toolbar {
                display: flex;
                gap: 12px;
                align-items: flex-end;
                flex-wrap: wrap;
                margin-bottom: 20px;
            }

            .xc-cam-toolbar .xc-tb-group {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .xc-cam-toolbar .xc-tb-group.flex-2 {
                flex: 2;
                min-width: 180px;
            }

            .xc-cam-toolbar .xc-tb-group.flex-1 {
                flex: 1;
                min-width: 140px;
            }

            .xc-cam-toolbar label {
                font-size: 12.5px;
                font-weight: 500;
                color: #444;
            }

            .xc-cam-toolbar select,
            .xc-cam-toolbar input {
                height: 42px;
                border: 1px solid #dde0e6;
                border-radius: 8px;
                font-size: 13px;
                color: #333;
                background: #fafbfc;
                padding: 0 13px;
                box-shadow: none;
                width: 100%;
                transition: border-color .15s, box-shadow .15s;
            }

            .xc-cam-toolbar select:focus,
            .xc-cam-toolbar input:focus {
                border-color: #0fb4a0;
                box-shadow: 0 0 0 3px rgba(15, 180, 160, .12);
                outline: none;
                background: #fff;
            }

            .xc-cam-toolbar input::placeholder {
                color: #bbb;
            }

            .btn-xc-addcam {
                height: 42px;
                padding: 0 24px;
                white-space: nowrap;
                background: #0fb4a0;
                color: #fff;
                border: none;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 500;
                cursor: pointer;
                transition: background .15s;
                align-self: flex-end;
            }

            .btn-xc-addcam:hover {
                background: #0d9b89;
            }

            /* Floor map container */
            #floor-map {
                position: relative;
                width: 100%;
                min-height: 520px;
                border: 1.5px solid #e4e6ea;
                border-radius: 10px;
                overflow: hidden;
                background: #1a1a2e;
            }

            #floorImage {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: contain;
                position: absolute;
                top: 0;
                left: 0;
                user-select: none;
                pointer-events: none;
            }

            /* ── Camera Marker ── */
            .camera-marker {
                position: absolute;
                display: flex;
                flex-direction: column;
                align-items: center;
                cursor: grab;
                z-index: 100;
                user-select: none;
                transform: translate(-50%, -50%);
                transition: filter .15s;
            }

            .camera-marker:active {
                cursor: grabbing;
            }

            .camera-marker:hover {
                filter: drop-shadow(0 0 8px rgba(15, 180, 160, .9));
            }

            /* Camera SVG body */
            .cam-body {
                width: 52px;
                height: 52px;
                background: #0fb4a0;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 14px rgba(0, 0, 0, .35);
                position: relative;
            }

            /* Lens ring */
            .cam-lens-outer {
                width: 26px;
                height: 26px;
                border-radius: 50%;
                background: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: inset 0 0 0 2px rgba(0, 0, 0, .15);
            }

            .cam-lens-inner {
                width: 16px;
                height: 16px;
                border-radius: 50%;
                background: #1a1a2e;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .cam-lens-dot {
                width: 5px;
                height: 5px;
                border-radius: 50%;
                background: #fff;
                opacity: .6;
            }

            /* Flash dot top-right */
            .cam-flash {
                position: absolute;
                top: 6px;
                right: 7px;
                width: 7px;
                height: 7px;
                border-radius: 50%;
                background: #fff;
                opacity: .85;
            }

            /* Pin triangle below body */
            .cam-pin {
                width: 0;
                height: 0;
                border-left: 8px solid transparent;
                border-right: 8px solid transparent;
                border-top: 10px solid #0fb4a0;
                margin-top: -1px;
                filter: drop-shadow(0 2px 3px rgba(0, 0, 0, .2));
            }

            /* Label */
            .cam-label {
                margin-top: 5px;
                background: rgba(15, 180, 160, .92);
                color: #fff;
                font-size: 10px;
                font-weight: 700;
                padding: 2px 10px;
                border-radius: 20px;
                white-space: nowrap;
                letter-spacing: .04em;
                box-shadow: 0 1px 6px rgba(0, 0, 0, .2);
            }

            /* Delete X (show on hover) */
            .cam-delete {
                position: absolute;
                top: -7px;
                right: -7px;
                width: 20px;
                height: 20px;
                background: #ef4444;
                color: #fff;
                border-radius: 50%;
                border: 2px solid #fff;
                font-size: 11px;
                font-weight: 700;
                cursor: pointer;
                display: none;
                align-items: center;
                justify-content: center;
                line-height: 1;
                padding: 0;
                z-index: 10;
                box-shadow: 0 2px 6px rgba(0, 0, 0, .25);
            }

            .camera-marker:hover .cam-delete {
                display: flex;
            }

            /* No floor state */
            .xc-no-floor {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                color: #9aa0ac;
                font-size: 14px;
            }

            .xc-no-floor svg {
                display: block;
                margin: 0 auto 12px;
            }

            /* Camera tag list */
            .xc-cam-list {
                margin-top: 14px;
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
            }

            .xc-cam-tag {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                background: #e0f7f4;
                color: #0a7a6b;
                border-radius: 20px;
                padding: 5px 14px;
                font-size: 12px;
                font-weight: 500;
            }

            .xc-cam-tag .tag-pos {
                font-size: 10px;
                color: #9aa0ac;
            }

            /* Footer */
            .xc-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 20px;
            }

            .btn-xc-back {
                height: 42px;
                padding: 0 24px;
                background: #fff;
                color: #555;
                border: 1px solid #dde0e6;
                border-radius: 8px;
                font-size: 13.5px;
                font-weight: 500;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                transition: background .15s;
            }

            .btn-xc-back:hover {
                background: #f5f5f5;
                color: #333;
                text-decoration: none;
            }

            .btn-xc-finish {
                height: 42px;
                padding: 0 32px;
                background: #0fb4a0;
                color: #fff;
                border: none;
                border-radius: 8px;
                font-size: 13.5px;
                font-weight: 500;
                cursor: pointer;
                transition: background .15s;
                display: inline-flex;
                align-items: center;
                gap: 6px;
            }

            .btn-xc-finish:hover {
                background: #0d9b89;
            }

            .btn-xc-finish:disabled {
                background: #a0d8d2;
                cursor: not-allowed;
            }

            /* Toast */
            .xc-toast {
                position: fixed;
                bottom: 24px;
                right: 24px;
                background: #1a1a2e;
                color: #fff;
                padding: 11px 18px;
                border-radius: 10px;
                font-size: 13px;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 8px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, .18);
                z-index: 9999;
                opacity: 0;
                transform: translateY(10px);
                transition: opacity .25s, transform .25s;
                pointer-events: none;
            }

            .xc-toast.show {
                opacity: 1;
                transform: translateY(0);
            }

            .xc-toast .ti {
                font-size: 16px;
            }

            .xc-toast.success .ti {
                color: #0fb4a0;
            }

            .xc-toast.error .ti {
                color: #ef4444;
            }
        </style>

        <div class="xc-wrapper">
            <div class="xc-content">

                <div class="xc-header">
                    <h2>Camera Mapping</h2>
                </div>
                <div class="xc-breadcrumb">
                    <a href="<?= base_url('dashboard') ?>">Project Monitoring</a>
                    <span>›</span> Camera Mapping
                </div>

                <!-- Wizard -->
                <div class="xc-wizard">
                    <div class="xc-wizard-step done">
                        <div class="step-circle">✓</div>
                        <div class="step-label">Project Details</div>
                    </div>
                    <div class="xc-wizard-connector done"></div>
                    <div class="xc-wizard-step done">
                        <div class="step-circle">✓</div>
                        <div class="step-label">Floors</div>
                    </div>
                    <div class="xc-wizard-connector done"></div>
                    <div class="xc-wizard-step done">
                        <div class="step-circle">✓</div>
                        <div class="step-label">Areas</div>
                    </div>
                    <div class="xc-wizard-connector done"></div>
                    <div class="xc-wizard-step active">
                        <div class="step-circle">4</div>
                        <div class="step-label">Camera Mapping</div>
                    </div>
                </div>

                <!-- Main card -->
                <div class="xc-form-card">

                    <div class="xc-section-label">Place Cameras on Floor Plan</div>

                    <!-- Toolbar -->
                    <div class="xc-cam-toolbar">
                        <div class="xc-tb-group flex-2">
                            <label>Select Floor</label>
                            <select id="floor_select">
                                <?php foreach ($floors as $floor): ?>
                                    <option value="<?= $floor->id ?>"
                                        data-image="<?= base_url('uploads/floor_plan/' . $floor->floor_image) ?>">
                                        <?= htmlspecialchars($floor->floor_name) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="xc-tb-group flex-2">
                            <label>Camera Name</label>
                            <input type="text" id="camera_name" placeholder="e.g. Entrance Camera">
                        </div>
                        <button type="button" id="addCamera" class="btn-xc-addcam">
                            + Add Camera
                        </button>
                    </div>

                    <!-- Floor map -->
                    <div id="floor-map">

                        <?php foreach ($cameras as $cam): ?>

                            <div class="camera-marker" style="
        left:<?= $cam->x_position ?>px;
        top:<?= $cam->y_position ?>px;
        transform:none;
     " data-id="<?= $cam->id ?>">

                                <div class="cam-body">
                                    <div class="cam-flash"></div>

                                    <div class="cam-lens-outer">
                                        <div class="cam-lens-inner">
                                            <div class="cam-lens-dot"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="cam-pin"></div>

                                <div class="cam-label">
                                    CAM-
                                    <?= $cam->camera_no ?>
                                </div>

                            </div>

                        <?php endforeach; ?>
                        <?php if ($selected_floor): ?>
                            <img src="<?= base_url('uploads/floor_plan/' . $selected_floor->floor_image) ?>" id="floorImage"
                                alt="Floor Plan">
                        <?php else: ?>
                            <div class="xc-no-floor">
                                <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="#9aa0ac"
                                    stroke-width="1.2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <path d="M3 9h18M9 21V9" />
                                </svg>
                                No floor plan available.<br>Please add a floor first.
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Camera tag list -->
                    <div class="xc-cam-list" id="camList"></div>

                    <!-- Footer -->
                    <div class="xc-footer">
                        <a href="javascript:history.back()" class="btn-xc-back">← Back</a>
                        <button type="button" class="btn-xc-finish" id="finishBtn">Save & Finish →</button>
                    </div>

                </div>

            </div>
        </div>

        <!-- Toast -->
        <div class="xc-toast" id="xcToast">
            <span class="ti" id="xcToastIcon"></span>
            <span id="xcToastMsg"></span>
        </div>


        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script> -->
        <script>
            window.onload = function () {

                let camCount = 0;

                function buildCameraMarker(camName) {
                    return `
        <div class="camera-marker" data-cam="${camName}">
            <button class="cam-delete" title="Remove">✕</button>
            <div class="cam-body">
                <div class="cam-flash"></div>
                <div class="cam-lens-outer">
                    <div class="cam-lens-inner">
                        <div class="cam-lens-dot"></div>
                    </div>
                </div>
            </div>
            <div class="cam-pin"></div>
            <div class="cam-label">${camName}</div>
        </div>`;
                }

                function showToast(msg, type) {
                    var t = document.getElementById('xcToast');
                    document.getElementById('xcToastMsg').textContent = msg;
                    document.getElementById('xcToastIcon').textContent = type === 'success' ? '✓' : '✕';
                    t.className = 'xc-toast ' + type + ' show';
                    setTimeout(() => t.classList.remove('show'), 3000);
                }

                $('.camera-marker').draggable({

                    containment: '#floor-map',

                    stop: function (event, ui) {

                        let camName = $(this)
                            .find('.cam-label')
                            .text()
                            .trim();

                        saveCamera(
                            $('#floor_select').val(),
                            camName,
                            ui.position.left,
                            ui.position.top
                        );
                    }
                });
                $('#floor_select').on('change', function () {

                    var img = $(this).find(':selected').data('image');

                    if (img) {
                        if ($('#floorImage').length) {
                            $('#floorImage').attr('src', img);
                        } else {
                            $('#floor-map').html(
                                '<img src="' + img + '" id="floorImage" alt="Floor Plan">'
                            );
                        }
                    }

                    // $('.camera-marker').remove();
                    $('#camList').empty();
                    camCount = 0;
                });

                $('#addCamera').on('click', function () {

                    var floorId = $('#floor_select').val();
                    var camName = $('#camera_name').val().trim();

                    if (!floorId) {
                        showToast('Please select a floor first.', 'error');
                        return;
                    }

                    camCount++;

                    if (!camName) {
                        camName = 'CAM-' + String(camCount).padStart(2, '0');
                    }

                    var offsetX = 80 + ((camCount - 1) % 5) * 70;
                    var offsetY = 80 + Math.floor((camCount - 1) / 5) * 90;

                    var $marker = $(buildCameraMarker(camName));

                    $marker.css({
                        top: offsetY + 'px',
                        left: offsetX + 'px',
                        transform: 'none'
                    });

                    $('#floor-map').append($marker);

                    if ($.fn.draggable) {

                        $marker.draggable({
                            containment: '#floor-map',
                            cursor: 'grabbing',
                            zIndex: 999,

                            drag: function (event, ui) {

                                var tagId = '#camTag-' + camName.replace(/[\s-]/g, '_');

                                $(tagId)
                                    .find('.tag-pos')
                                    .text(
                                        'x:' +
                                        Math.round(ui.position.left) +
                                        ' y:' +
                                        Math.round(ui.position.top)
                                    );
                            },

                            stop: function (event, ui) {

                                saveCamera(
                                    floorId,
                                    camName,
                                    ui.position.left,
                                    ui.position.top
                                );
                            }
                        });

                    } else {
                        console.log('jQuery UI draggable not loaded');
                    }

                    $marker.find('.cam-delete').on('click', function (e) {

                        e.stopPropagation();

                        $marker.remove();

                        $('#camTag-' + camName.replace(/[\s-]/g, '_')).remove();

                        showToast(camName + ' removed.', 'success');
                    });

                    var tagId = 'camTag-' + camName.replace(/[\s-]/g, '_');

                    $('#camList').append(
                        '<div class="xc-cam-tag" id="' + tagId + '">' +
                        camName +
                        ' <span class="tag-pos">x:' +
                        offsetX +
                        ' y:' +
                        offsetY +
                        '</span></div>'
                    );

                    $('#camera_name').val('');

                    saveCamera(
                        floorId,
                        camName,
                        offsetX,
                        offsetY
                    );
                });

                function saveCamera(floorId, camName, x, y) {

                    $.ajax({
                        url: '<?= base_url("project/update_camera_position") ?>',
                        type: 'POST',
                        data: {
                            project_id: '<?= $project_id ?>',
                            floor_id: floorId,
                            camera_name: camName,
                            x: Math.round(x),
                            y: Math.round(y)
                        }
                    });
                }

                $('#finishBtn').on('click', function () {

                    alert('Camera Mapping Updated Successfully');

                    window.location.href =
                        '<?= base_url("project/project_list") ?>';

                });

            };
        </script>
    </div>
</div>

