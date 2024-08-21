<!doctype html>
<html lang="en">
    <head>
        <title>create user</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <?php include("../css.php")?>
    </head>
    <body class="bg-light">
        <div class="container pt-3">
            <div class="p-3 bg-white shadow-sm rounded-2 mb-4">
                <h5>課程管理/新增課程</h5><br>
                <h2>新增課程</h2>
            </div>
        </div>
        <div class="container pt-2">
            <div class="p-3 bg-white shadow-sm rounded-2 mb-4">
                <div class="d-flex">
                    <a href="course-list.php" class="btn" title="回到課程列表"><i class="fa-solid fa-arrow-left-long"></i></a>
                    <h2>新增課程</h2>   
                </div>
                <form action="doCrateUser.php" method="post">
                    <div class="d-flex">
                        <div class="box">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">課程名稱</label>
                            <input type="name" class="form-control" id="exampleFormControlInput1" placeholder="" name="name" required>
                            </div>
                            <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">課程說明</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="caption" required></textarea>
                            </div>
                            <div class="couese_type">
                                <h6>上課類別</h6>
                                <div class="d-flex mx-3">                           
                                    <div class="form-check mx-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        小提琴
                                    </label>
                                    </div>
                                    <div class="form-check mx-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        中提琴
                                    </label>
                                    </div>
                                    <div class="form-check mx-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        大提琴
                                    </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box">

                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </body>


<!-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddCrouse">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title"><i class="fa-regular fa-square-plus me-2"></i>新增課程</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                        </div>
                        <div class="offcanvas-body">
                            <form class="needs-validation " id="addCourseForm" enctype="multipart/form-data" novalidate>
                                <div class="mb-3 w-100  position-relative">
                                    <figure class="upload-container  ratio ratio-16x9 m-0">
                                        <img id="add_course_img" src="course_image/example.png" alt="" class="object-fit-cover card-img-top">
                                    </figure>
                                    <input type="file" name="file" id="add_course_file" style="display: none;">
                                    <div>
                                        <div class="position-absolute bottom-0 end-0 w-100 btn btn-light rounded-0 opacity-75" id="add_course_imgBtn"><i class="fa-solid fa-camera"></i></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="course_name" class="form-label">課程名稱</label>
                                    <input type="text" class="form-control" id="add_course_name" name="course_name" required>
                                    <div class="invalid-feedback">請輸入課程名稱。</div>
                                </div>
                                <div class="row">

                                    <div class="mb-3 col ">
                                        <label for="course_type_name" class="form-label">課程類別</label>
                                        <select class="form-select" id="add_course_type_id" name="add_course_type_id" required>
                                            <option value="">請選擇</option>
                                            <?php foreach ($typeRows as $type) : ?>
                                                <option value="<?= $type["course_type_id"] ?>"><?= $type["course_type_name"] ?></option>
                                            <?php endforeach ?>
                                        </select>

                                    </div>

                                    <div class="mb-3 col">
                                        <label for="course_level_name" class="form-label">課程難度</label>
                                        <select class="form-select" id="add_course_level_id" name="add_course_level_id" required>
                                            <option value="">請選擇</option>
                                            <?php foreach ($levelRows as $level) : ?>
                                                <option value="<?= $level["course_level_id"] ?>"><?= $level["course_level_name"] ?></option>
                                            <?php endforeach ?>
                                        </select>

                                    </div>
                                    <div class="mb-3 col">
                                        <label for="course_teacher_name" class="form-label">授課老師</label>
                                        <select class="form-select" id="add_course_teacher_id" name="add_course_teacher_id">
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
                                        <select class="form-select" id="add_course_location_id" name="add_course_location_id" required>
                                            <option value="">請選擇</option>
                                            <?php foreach ($locationRows as $location) : ?>
                                                <option value="<?= $location["course_location_id"] ?>"><?= $location["course_location_name"] ?></option>
                                            <?php endforeach ?>
                                        </select>

                                    </div>

                                    <div class="mb-3 col">
                                        <label for="course_price" class="form-label">價格</label>
                                        <input type="number" class="form-control" id="add_course_price" name="course_price" required>
                                        <div class="invalid-feedback">請輸入價格。</div>
                                    </div>
                                    <div class="mb-3 col">
                                        <label for="add_course_capacity" class="form-label">人數</label>
                                        <input type="number" class="form-control" id="add_course_capacity" name="course_capacity" required>
                                        <div class="invalid-feedback">請輸入人數。</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="sign_start_date" class="form-label">報名開始</label>
                                        <input type="date" class="form-control" id="add_sign_start_date" name="sign_start_date" required>
                                        <div class="invalid-feedback col-6">請選擇報名開始日期。</div>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="sign_end_date" class="form-label">報名結束</label>
                                        <input type="date" class="form-control" id="add_sign_end_date" name="sign_end_date" required>
                                        <div class="invalid-feedback col-6">請選擇報名結束日期。</div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="mb-3 col-6">
                                        <label for="course_start_date" class="form-label">課程開始</label>
                                        <input type="date" class="form-control" id="add_course_start_date" name="course_start_date" required>
                                        <div class="invalid-feedback col-6">請選擇課程開始日期。</div>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="course_end_date" class="form-label">課程結束</label>
                                        <input type="date" class="form-control" id="add_course_end_date" name="course_end_date" required>
                                        <div class="invalid-feedback col-6">請選擇課程結束日期。</div>
                                    </div>
                                </div>



                                <div class="mb-3">
                                    <label for="course_description" class="form-label">簡介</label>
                                    <textarea class="form-control" id="add_course_description" name="course_description " rows="5" style="resize:none"></textarea>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-secondary" id="resetAddCourse" type="button">清除</button>
                                    <button class="btn btn-warning" id="sendAddCourse" type="button"><i class="fa-regular fa-square-plus me-2"></i>新增課程</button>

                                </div>
                            </form>

                        </div>
                    </div> -->