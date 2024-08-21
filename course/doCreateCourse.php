<?php

require_once("../../../db_connect.php");

if(!isset($_POST["courseName"])){
    $data=[
        "status"=>0,
        "message"=>"無有效參數"
    ];
    echo json_encode($data);
    exit;
}

if(empty($_POST["courseName"])){
    $data=[
        "status"=>0,
        "message"=>"請輸入課程名稱"
    ];
    echo json_encode($data);
    exit;
}

$courseName=$_POST["courseName"];
$courseTypeId=$_POST["courseTypeId"];
$courseLevelId=$_POST["courseLevelId"];
$coursePrice=$_POST["coursePrice"];
$courseCapacity=$_POST["courseCapacity"];
$courseTeacherId=$_POST["courseTeacherId"];
$courseLocationId=$_POST["courseLocationId"];
$signStartDate=$_POST["signStartDate"];
$signEndDate=$_POST["signEndDate"];
$courseStartDate=$_POST["courseStartDate"];
$courseEndDate=$_POST["courseEndDate"];
$courseDescription=$_POST["courseDescription"];
$courseImage=$_POST["courseImage"];


$now=date('Y-m-d H:i:s');
$courseValid="1";


$sql="INSERT INTO course (course_name, course_type_id, course_level_id, teacher_id, course_price, sign_start_date, sign_end_date, course_start_date, course_end_date,course_location_id, course_capacity, course_description, course_image, course_created_at, course_valid) VALUES ('$courseName','$courseTypeId','$courseLevelId','$courseTeacherId','$coursePrice','$signStartDate','$signEndDate','$courseStartDate','$courseEndDate','$courseLocationId','$courseCapacity','$courseDescription','$courseImage','$now','$courseValid')";

if ($conn->query($sql) === TRUE) {
    $data=[
        "status"=>1,
        "message"=>"新增課程成功，即將刷新頁面"
    ];
    echo json_encode($data);

} else {
    // echo "新增資料錯誤: " . $conn->error;
    $data=[
        "status"=>0,
        "message"=>"新增資料錯誤: " . $conn->error
    ];
    echo json_encode($data);

}

// echo json_encode($data);
$conn->close();