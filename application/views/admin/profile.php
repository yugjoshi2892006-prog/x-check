<div class="page-wrapper">
    <div class="page-content">

        <div class="card shadow-sm">
            <div class="card-body">

                <form method="post" action="<?= base_url('profile/save') ?>" enctype="multipart/form-data">

                    <!-- Profile Top Section -->

                    <div class="text-center mb-5">

                        <?php

                        $profileImage = !empty($profile->profile_image)
                            ? base_url('assets/uploads/profile/' . $profile->profile_image)
                            : base_url('assets/images/default-user.png');

                        ?>

                        <img id="previewImage" src="<?= $profileImage ?>" class="rounded-circle shadow" style="
                                width:150px;
                                height:150px;
                                object-fit:cover;
                                border:5px solid #45c7d6;
                            ">

                        <h3 class="mt-3 mb-1">
                            <?= !empty($profile->company_name) ? $profile->company_name : 'Company Name' ?>
                        </h3>

                        <p class="text-muted">
                            COMPANY PROFILE
                        </p>

                        <div class="row justify-content-center">

                            <div class="col-md-4">

                                <input type="file" name="profile_image" id="profileImage" class="form-control">

                            </div>

                        </div>

                    </div>

                    <h4 class="mb-4">
                        My Profile
                    </h4>

                    <div class="row">

                        <!-- Company Name -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Company Name
                            </label>

                            <input type="text" name="company_name" class="form-control"
                                value="<?= isset($profile->company_name) ? $profile->company_name : '' ?>">

                        </div>

                        <!-- Contact Person -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Contact Person
                            </label>

                            <input type="text" name="contact_person" class="form-control"
                                value="<?= isset($profile->contact_person) ? $profile->contact_person : '' ?>">

                        </div>

                        <!-- Email -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input type="email" name="email" class="form-control"
                                value="<?= isset($profile->email) ? $profile->email : '' ?>">

                        </div>

                        <!-- Mobile -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Mobile
                            </label>

                            <input type="text" name="mobile" class="form-control"
                                value="<?= isset($profile->mobile) ? $profile->mobile : '' ?>">

                        </div>

                        <!-- Country -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Country
                            </label>

                            <input type="text" name="country" class="form-control"
                                value="<?= isset($profile->country) ? $profile->country : '' ?>">

                        </div>

                        <!-- State -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                State
                            </label>

                            <input type="text" name="state" class="form-control"
                                value="<?= isset($profile->state) ? $profile->state : '' ?>">

                        </div>

                        <!-- City -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                City
                            </label>

                            <input type="text" name="city" class="form-control"
                                value="<?= isset($profile->city) ? $profile->city : '' ?>">

                        </div>

                        <!-- Zip -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Zip Code
                            </label>

                            <input type="text" name="zipcode" class="form-control"
                                value="<?= isset($profile->zipcode) ? $profile->zipcode : '' ?>">

                        </div>

                        <!-- Address -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">
                                Address
                            </label>

                            <textarea name="address" rows="3"
                                class="form-control"><?= isset($profile->address) ? $profile->address : '' ?></textarea>

                        </div>

                        <!-- GST -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                GST Number
                            </label>

                            <input type="text" name="gst_number" class="form-control"
                                value="<?= isset($profile->gst_number) ? $profile->gst_number : '' ?>">

                        </div>

                        <!-- Tax -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Tax ID
                            </label>

                            <input type="text" name="tax_id" class="form-control"
                                value="<?= isset($profile->tax_id) ? $profile->tax_id : '' ?>">

                        </div>

                        <!-- Industry -->

                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Industry Type
                            </label>

                            <input type="text" name="industry_type" class="form-control"
                                value="<?= isset($profile->industry_type) ? $profile->industry_type : '' ?>">

                        </div>

                        <!-- Button -->

                        <div class="col-md-12">

                            <button type="submit" class="btn btn-primary px-4">

                                <i class="bx bx-save"></i>
                                Update Profile

                            </button>

                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<script>

    document.getElementById('profileImage')
        .addEventListener('change', function (e) {

            let reader = new FileReader();

            reader.onload = function () {

                document.getElementById('previewImage').src =
                    reader.result;

            };

            reader.readAsDataURL(e.target.files[0]);

        });

</script>
