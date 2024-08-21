<!-- 編輯課程offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditCrouse">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title"><i class="fa-solid fa-pen-to-square me-2"></i>編輯課程</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form class="needs-validation " id="editCourseForm" novalidate>
            <div class="mb-3 w-100  position-relative">
                <figure class="upload-container  ratio ratio-16x9 m-0">
                    <img id="edit_course_img" src="course_image/example.png" alt="" class="object-fit-cover card-img-top">
                </figure>
                <input type="file" multiple="multiple" name="file" id="edit_course_file" style="display: none;">
                <div>
                    <button class="position-absolute bottom-0 end-0 w-100 btn btn-light rounded-0 opacity-75" type="button" id="edit_course_imgBtn"><i class="fa-solid fa-camera"></i></button>
                </div>
            </div>
            <div class="mb-3">
                <label for="course_name" class="form-label">課程名稱</label>
                <input type="text" class="form-control" id="edit_course_name" name="course_name" value="" required>
                <div class="invalid-feedback">請輸入課程名稱。</div>
            </div>
            <div class="row">

                <div class="mb-3 col ">
                    <label for="course_type_name" class="form-label">課程類別</label>
                    <select class="form-select" id="edit_course_type_id" name="edit_course_type_id" required>
                        <option value="">請選擇</option>
                        <?php foreach ($typeRows as $type) : ?>
                            <option value="<?= $type["course_type_id"] ?>"><?= $type["course_type_name"] ?></option>
                        <?php endforeach ?>
                    </select>

                </div>

                <div class="mb-3 col">
                    <label for="course_level_name" class="form-label">課程難度</label>
                    <select class="form-select" id="edit_course_level_id" name="edit_course_level_id" required>
                        <option value="">請選擇</option>
                        <?php foreach ($levelRows as $level) : ?>
                            <option value="<?= $level["course_level_id"] ?>"><?= $level["course_level_name"] ?></option>
                        <?php endforeach ?>
                    </select>

                </div>



                <div class="mb-3 col">
                    <label for="course_teacher_name" class="form-label">授課老師</label>
                    <select class="form-select" id="edit_course_teacher_id" name="edit_course_teacher_id">
                        <option value="">請選擇</option>
                        <?php foreach ($teacherRows as $teacher) : ?>
                            <option value="<?= $teacher["teacher_id"] ?>"><?= $teacher["teacher_name"] ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col">
                    <label for="course_location_name" class="form-label">授課地點</label>
                    <select class="form-select" id="edit_course_location_id" name="edit_course_location_id" required>
                        <option value="">請選擇</option>
                        <?php foreach ($locationRows as $location) : ?>
                            <option value="<?= $location["course_location_id"] ?>"><?= $location["course_location_name"] ?></option>
                        <?php endforeach ?>
                    </select>

                </div>

                <div class="mb-3 col">
                    <label for="course_price" class="form-label">價格</label>
                    <input type="number" class="form-control" id="edit_course_price" name="course_price" required>
                    <div class="invalid-feedback">請輸入價格。</div>
                </div>
                <div class="mb-3 col">
                    <label for="edit_course_capacity" class="form-label">人數</label>
                    <input type="number" class="form-control" id="edit_course_capacity" name="course_capacity" required>
                    <div class="invalid-feedback">請輸入人數。</div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="sign_start_date" class="form-label">報名開始</label>
                    <input type="date" class="form-control" id="edit_sign_start_date" name="sign_start_date" required>
                    <div class="invalid-feedback col-6">請選擇報名開始日期。</div>
                </div>

                <div class="mb-3 col-6">
                    <label for="sign_end_date" class="form-label">報名結束</label>
                    <input type="date" class="form-control" id="edit_sign_end_date" name="sign_end_date" required>
                    <div class="invalid-feedback col-6">請選擇報名結束日期。</div>
                </div>
            </div>

            <div class="row">

                <div class="mb-3 col-6">
                    <label for="course_start_date" class="form-label">課程開始</label>
                    <input type="date" class="form-control" id="edit_course_start_date" name="course_start_date" required>
                    <div class="invalid-feedback col-6">請選擇課程開始日期。</div>
                </div>

                <div class="mb-3 col-6">
                    <label for="course_end_date" class="form-label">課程結束</label>
                    <input type="date" class="form-control" id="edit_course_end_date" name="course_end_date" required>
                    <div class="invalid-feedback col-6">請選擇課程結束日期。</div>
                </div>
            </div>



            <div class="mb-3">
                <label for="course_description" class="form-label">簡介</label>
                <textarea class="form-control" id="edit_course_description" name="course_description " rows="5" style="resize:none"></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-warning" id="sendEditCourse" type="button"><i class="fa-solid fa-pen-to-square me-2"></i>送出修改</button>

            </div>
        </form>

    </div>
</div><!-- 編輯課程offcanvas end-->