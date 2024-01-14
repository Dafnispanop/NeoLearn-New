<?php
session_start();
require '../connect.php';
// this has to be a session variable with the user id if it is a teacher
if (!isset($_SESSION['id'])) {
    header("Location: ../Login/login.php");
    exit();
}

$userId= $_SESSION['id'];

if(isset($_POST['save_student']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    if($name == NULL || $course == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO lessons (teacher_id,name,course) VALUES ('$userId','$name','$course')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Lesson Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Lesson Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['save_video']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = mysqli_real_escape_string($conn, $_POST['url']);
    $week = mysqli_real_escape_string($conn, $_POST['week']);
    $lesson_id = mysqli_real_escape_string($conn, $_POST['lesson']);

    if($name == NULL || $location == NULL || $week == NULL || $lesson_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO videos (lesson_id,week,name,location) VALUES ('$lesson_id','$week','$name','$location')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Video Uploaded Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Video Not Uploaded'
        ];
        echo json_encode($res);
        return;
    }
}

//$user_id=9;
/* $user_id=10; */
if(isset($_POST['sub_lesson']))
{
    $lesson = mysqli_real_escape_string($conn, $_POST['lesson']);
    

    if($lesson == NULL )
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }


    $query = "INSERT INTO subscriptions (student_id,lesson_id) VALUES ('$userId','$lesson')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Succesfully subscribed'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Could not subscribe'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    if($name == NULL || $course == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE lessons SET name='$name', course='$course' 
                WHERE id='$student_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Lesson Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Lesson Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['student_id']))
{
    $student_id = mysqli_real_escape_string($conn, $_GET['student_id']);

    $query = "SELECT * FROM lessons WHERE id='$student_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Lesson Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Lesson Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_GET['lesson_id']))
{
    $lesson_id = mysqli_real_escape_string($conn, $_GET['lesson_id']);

    if(isset($_SESSION['clickedlesson'])){
        unset($_SESSION['clickedlesson']);
    }
    $_SESSION['clickedlesson'] = $lesson_id;



    $query = "SELECT * FROM lessons WHERE id='$lesson_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $lesson = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Lesson Fetch Successfully by id',
            'data' => $lesson
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Lesson Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);

    $query = "DELETE FROM lessons WHERE id='$student_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Lesson Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Lesson Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_pdf']))
{
    $pdf_id = mysqli_real_escape_string($conn, $_POST['pdf_id']);

    $query = "DELETE FROM pdfs WHERE id='$pdf_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Pdf Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Pdf Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_video']))
{
    $video_id = mysqli_real_escape_string($conn, $_POST['video_id']);

    $query = "DELETE FROM videos WHERE id='$video_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Video Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Video Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}



if(isset($_POST['delete_lesson']))
{
    $subscription_id = mysqli_real_escape_string($conn, $_POST['lesson_id']);
    
    //$les = 1;
    $query = "DELETE FROM subscriptions WHERE lesson_id ='$subscription_id' AND student_id='$userId'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Successfully Unsubscribed'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Could not unsubscribe!!!'
        ];
        echo json_encode($res);
        return;
    }
}

?>