<!-- php &SQL 語法開始 -->
<?php
require_once("../db_connect.php");

$whereClause = "WHERE ";

//顯示刪除課程
if (isset($_GET["valid"])) {
    $valid = $_GET["valid"];
    $whereClause .= " course.course_valid = 2";
} else {
    $valid = 1;
    $whereClause .= " course.course_valid = 1";
}

//狀態篩選
if(isset($_GET["status"])){
    $now = date("Y-m-d H:i:s");
    $status =$_GET["status"];
    switch ($status) {
        case "NotStarted":
            $whereClause .= "  AND course_registration_start > '$now' ";
            break;
        case "RegistrationOpen":
            $whereClause .= "  AND course_registration_start <= '$now' AND course_registration_end >= '$now' AND course_student_limit > course_registered_students";
            break;
        case "Registrationfull":
            $whereClause .= "  AND course_registration_start <= '$now' AND course_registration_end >= '$now' AND course_student_limit <= course_registered_students";
            break;
        case "RegistrationClosed":
            $whereClause .= " AND course_registration_end < '$now'";
            break;
        case 'InProgress':
            $whereClause .= " AND course_start_time <= '$now' AND course_removal_time >= '$now'";
            break;
        case 'discontinued':
            $whereClause .= " AND course_removal_time <= '$now'";
            break;
        default:
            break;
    }
}
//篩選
//課程代碼
if (isset($_GET["code"])) {
    $search = $_GET["code"];
    $whereClause .= " AND course.course_code = $code";
}
//課程類型
if (isset($_GET["type"])) {
    $type = $_GET["type"];
    $whereClause .= " AND course.course_instrument_type = $type";
}
//課程難度
if (isset($_GET["level"])) {
    $level = $_GET["level"];
    $whereClause .= " AND course.course_level = $level";
}
//教室代碼
// if (isset($_GET["classroom"])) {
//     $location = $_GET["classroom"];
//     $whereClause .= " AND course.course_room_number = $classroom";
// }

//開課日期
if (isset($_GET["dateFrom"]) && isset($_GET["dateTo"])) {
    $dateFrom = $_GET["dateFrom"];
    $dateTo = $_GET["dateTo"];
    $whereClause .= " AND course.course_start_date >= '$dateFrom' AND course.course_start_date <= '$dateTo'";
} elseif (isset($_GET["dateFrom"]) && $_GET["dateFrom"] != "") {
    $dateFrom = $_GET["dateFrom"];
    $whereClause .= " AND course.course_start_date >= '$dateFrom'";
} elseif (isset($_GET["dateTo"]) && $_GET["dateTo"] != "") {
    $dateTo = $_GET["dateTo"];
    $whereClause .= " AND course.course_start_date <= '$dateTo'";
}

// 排序
$orderClause = "ORDER BY ";
if (isset($_GET["orderby"])) {
    $orderby = $_GET["orderby"];

    switch ($orderby) {
        case 1:
            $orderClause .= " course_created_at DESC";
            break;
        case 2:
            $orderClause .= "course_registration_start DESC";
            break;
        case 3:
            $orderClause .= "course_registration_start ASC";
            break;
        case 4:
            $orderClause .= "course_start_date DESC";
            break;
        case 5:
            $orderClause .= "course_start_date ASC";
            break;

        default:
            $orderClause .= " course_created_at DESC";
            break;
    }
} else {
    $orderClause .= " course_created_at DESC";
}
//無篩選資料計算
$sqlAll = "SELECT * FROM course WHERE course_valid=$valid";
$resultAll = $conn->query($sqlAll);
$countAll = $resultAll->num_rows;
$now = date("Y-m-d");

//尚未開始報名
$sqlNotStarted = "SELECT * FROM course WHERE course_valid=$valid AND course_registration_start > '$now'";
$resultNotStarted = $conn->query($sqlNotStarted);
$countNotStarted = $resultNotStarted->num_rows;
//報名開放中
$sqlOpen = "SELECT * FROM course WHERE course_valid=$valid AND course_registration_start <= '$now' AND course_registration_end >= '$now' AND course_student_limit > course_registered_students";
$resultOpen = $conn->query($sqlOpen);
$countOpen = $resultOpen->num_rows;
//報名名額額滿
$sqlFull = "SELECT * FROM course WHERE course_valid=$valid AND course_registration_start <= '$now' AND course_registration_end >= '$now' AND course_student_limit <= course_registered_students";
$resultFull = $conn->query($sqlFull);
$countFull = $resultFull->num_rows;
//報名截止
$sqlClose = "SELECT * FROM course WHERE course_valid=$valid AND course_registration_end < '$now'";
$resultClose = $conn->query($sqlClose);
$countClose = $resultClose->num_rows;
//課程進行中
$sqlCoursing = "SELECT * FROM course WHERE course_valid=$valid AND course_start_date <= '$now'";
$resultCoursing = $conn->query($sqlCoursing);
$countCoursing = $resultCoursing->num_rows;
//課程下架
$sqlDiscontinued = "SELECT * FROM course WHERE course_valid=$valid AND course_removal_time <= '$now'";
$resultDiscontinued = $conn->query($sqlDiscontinued);
$countDiscontinued = $resultDiscontinued->num_rows;


// 總筆數
$sqlTotal = "SELECT * FROM course 
LEFT JOIN course_instrument_type ON  course_instrument_type.type_id=course.course_instrument_type
LEFT JOIN course_level ON  course_level.level_id=course.course_level 
-- LEFT JOIN coffseeker_teachers ON coffseeker_teachers.teacher_id = course.teacher_id

$whereClause 
$orderClause
";

// 分頁定義
$page = $_GET["page"] ?? 1;

if (isset($_GET["perPage"])) {
    $perPage = $_GET["perPage"];
} else {

    $perPage = 5;
}

$startItem = ($page - 1) * $perPage;

$resultTotal = $conn->query($sqlTotal);
$rowsTotal = $resultTotal->fetch_all(MYSQLI_ASSOC);

//計算總筆數
$totalResult = $resultTotal->num_rows;
//計算總頁數
$totalPage = ceil($totalResult / $perPage);
$limitClause = "LIMIT $startItem, $perPage";


$sql = "SELECT * FROM course 
LEFT JOIN course_instrument_type ON  course_instrument_type.type_id=course.course_instrument_type
LEFT JOIN course_level ON  course_level.level_id=course.course_level 
-- 要join老師
-- LEFT JOIN coffseeker_teachers ON coffseeker_teachers.teacher_id = course.teacher_id
$whereClause 
$orderClause
$limitClause
";

$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

// JOIN的資料表們query出來
$sqlType = "SELECT * FROM course_instrument_type ";
$resultType = $conn->query($sqlType);
$typeRows = $resultType->fetch_all(MYSQLI_ASSOC);

$sqlLevel = "SELECT * FROM course_level ";
$resultLevel = $conn->query($sqlLevel);
$levelRows = $resultLevel->fetch_all(MYSQLI_ASSOC);


// $sqlTeacher = "SELECT * FROM  coffseeker_teachers WHERE valid='1'";
// $resultTeacher = $conn->query($sqlTeacher);
// $teacherRows = $resultTeacher->fetch_all(MYSQLI_ASSOC);

//統整網址GET參數
$allGet = [
    'search' => isset($_GET["search"]) ? $_GET["search"] : null,
    'type' => isset($_GET["type"]) ? $_GET["type"] : null,
    'level' => isset($_GET["level"]) ? $_GET["level"] : null,
    'classroom' => isset($_GET["classroom"]) ? $_GET["classroom"] : null,
    'valid' => isset($_GET["valid"]) ? $_GET["valid"] : null,
    'orderby' => isset($_GET["orderby"]) ? $_GET["orderby"] : null,
    'dateFrom' => isset($_GET["dateFrom"]) ? $_GET["dateFrom"] : null,
    'dateTo' => isset($_GET["dateTo"]) ? $_GET["dateTo"] : null,
    'perPage' => isset($_GET["perPage"]) ? $_GET["perPage"] : null,
    'status' => isset($_GET["status"]) ? $_GET["status"] : null,

];

$allGetString = http_build_query(array_filter($allGet));
// var_dump($allGetString);

$allGetXV = [
    'search' => isset($_GET["search"]) ? $_GET["search"] : null,
    'type' => isset($_GET["type"]) ? $_GET["type"] : null,
    'level' => isset($_GET["level"]) ? $_GET["level"] : null,
    'location' => isset($_GET["location"]) ? $_GET["location"] : null,
    'orderby' => isset($_GET["orderby"]) ? $_GET["orderby"] : null,
    'dateFrom' => isset($_GET["dateFrom"]) ? $_GET["dateFrom"] : null,
    'dateTo' => isset($_GET["dateTo"]) ? $_GET["dateTo"] : null,
    'perPage' => isset($_GET["perPage"]) ? $_GET["perPage"] : null,
    'status' => isset($_GET["status"]) ? $_GET["status"] : null,

];

$allGetStringXV = http_build_query(array_filter($allGetXV));

?>

<!doctype html>
<html lang="en">

<head>
    <title><?= isset($_GET["valid"]) ? "【已下架】" : "" ?>課程列表</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <?php include("../css.php") ?>
    <link
        rel="stylesheet"
        href="style.css">
</head>

<body class="bg-light">

    <div class="container pt-3">
        <div class="p-3 bg-white shadow-sm rounded-2 mb-4">
        
            <div class="row g-2 align-items-center mb-2">
                <!-- 此段未更改 -->
                <?php if (isset($_GET["date"]) || (isset($_GET["user"])) || (isset($_GET["product"]))) : ?>
                    <div class="col-auto">
                        <a class="btn btn-primary" href="order-list.php"><i class="fa-solid fa-circle-chevron-left"></i></a>
                    </div>
                <?php endif; ?>
                
                <div class="col">
                    <h1 class="m-0"><?= isset($_GET["valid"]) ? "【已下架】" : "" ?>課程列表</h1>
                </div>
            </div>
            <?php if (!isset($_GET["product"]) && !isset($_GET["user"]) && !isset($_GET["date"])) : ?>
                <div class="py-2">
                    <form action="">
                        <?php
                        $today = date('Y-m-d');
                        $start = isset($_GET["start"]) ? $_GET["start"] :
                            $today;
                        $end = isset($_GET["end"]) ? $_GET["end"] : $today;
                        ?>
                        <div class="row g-2">
                            <?php if (isset($_GET["start"])) : ?>
                                <div class="col-auto">
                                    <a class="btn btn-primary" href="order-list.php"><i class="fa-solid fa-circle-chevron-left"></i></a>
                                </div>
                            <?php endif; ?>
                            <!-- 此段未更改到這邊 -->
                            <div class="col-3 form-floating">
                                <input type="code" class="form-control" id="code" placeholder="code" name="code">
                                <label for="floatingCode">課程代碼</label>
                            </div>
                            <div class="col-3 form-floating">
                                <input type="couponSid" class="form-control" id="teacher" placeholder="teacher" name="teacher">
                                <label for="floatingTeacher">老師</label>
                            </div>
                            <div class="col-3 form-floating">
                                <input type="date" class="form-control" name="start" value="<?= $start ?>">
                                <label for="floatingSign">報名開始日期</label>
                            </div>
                            <div class="col-3 form-floating">
                                <input type="date" class="form-control" name="end" value="<?= $end ?>">
                                <label for="floatingSign">報名結束日期</label>
                            </div>
                        </div>
                        <div class="row g-2 d-flex justify-content-between pt-3 align-items-center">
                            <div class="col-3 form-floating">
                                <select name="type" class="form-select" id="type" placeholder="type" name="type">
                                    <option value="所有類別">所有類別</option>
                                    <option value="小提琴">小提琴</option>
                                    <option value="中提琴">中提琴</option>
                                    <option value="大提琴">大提琴</option>
                                </select>
                                <label for="floatingType">課程類別</label>
                            </div>
                            <div class="col-3 form-floating">
                                <select name="level" class="form-select" id="level" placeholder="level" name="level">
                                    <option value="所有類別">所有級別</option>
                                    <option value="初級">初級</option>
                                    <option value="中級">中級</option>
                                    <option value="高級">高級</option>
                                </select>
                                <label for="floatingLevel">課程級別</label>
                            </div>        
                            <div class="col-3 form-floating">
                                <select name="state" class="form-select" id="state" placeholder="state" name="state">
                                    <option value="所有狀態">所有狀態</option>
                                    <option value="尚未開始報名">尚未開始報名</option>
                                    <option value="報名開放中">報名開放中</option>
                                    <option value="名額已額滿">名額已額滿</option>
                                    <option value="報名截止">報名截止</option>
                                    <option value="開課中">開課中</option>
                                    <option value="已下架">已下架</option>
                                </select>
                                <label for="floatingState">課程狀態</label>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                                <button type="submit" class="btn btn-dark btn-lg">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
        <div class="p-3 bg-white shadow-sm rounded-2">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <!-- if上方有輸入文字，則顯示查詢結果 -->
                <h6 class="m-0">查詢結果</h6>
                <a class="btn btn-primary" href="create_course.php">新增</a>
            </div>
            <table class="coupon-table table table-bordered">
                <thead>
                    <tr>
                        <th class="text-nowrap">課程代碼</th>
                        <th>上課項目</th>
                        <th>課程級別</th>
                        <th>授課教師</th>
                        <th>課程價格(堂)</th>
                        <th>報名人數</th>
                        <th>上課時間</th>
                        <th>課堂教室</th>
                        <th>開課時間</th>
                        <th>報名截止日</th>
                        <th>課程狀態</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row["course_code"] ?></td>
                            <td><?= $row["type_name"] ?></td>
                            <td><?= $row["level_name"] ?></td>
                            <td><a href="?teacher=<?= $row["teacher_id"] ?>"><?= $row["teacher_id"] ?></td>
                            <td>$<?= $row["course_price"] ?></td>
                            <td><a href="?date=<?= $row["order_date"] ?>"><?= $row["order_date"] ?></a></td>
                            <td><a href="?product=<?= $row["product_id"] ?>"><?= $row["product_name"] ?></a></td>
                            <td class="text-end"><?= number_format($row["price"]) ?></td>
                            <td class="text-end"><?= $row["amount"] ?></td>
                            <td><a href="?user=<?= $row["user_id"] ?>"><?= $row["user_name"] ?></a></td>
                            <?php
                            $subtotal = $row["price"] * $row["amount"];
                            $total += $subtotal;
                            ?>
                            <td class="text-end"><?= number_format($subtotal) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-end">
                總計：<?= number_format($total) ?>
            </div>
        </div>

    </div>
</body>

</html>