<?php
    session_start();
    require '../connect.php';
    //this variable must be a session variable
    if (!isset($_SESSION['id'])) {
        header("Location: ../Login/login.php");
        exit();
    }

    $userID = 12;

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Student</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="../styles.css"/>
</head>
<body>


<header>    

</header>


<?php
include("../Navbar/navbar.php");
?>


<!-- Add Lesson -->
<div class="modal fade" id="lessonAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Subscribe to a Lesson</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" id="saveLesson">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>


                <div class="mb-3">
                    <label for="">Lesson</label>
                    <select name="lesson" id="select_lesson">
                    <?php


                    $unsubed_lessons = ("SELECT id,name FROM lessons EXCEPT SELECT lesson_id,name FROM subscriptions RIGHT JOIN lessons ON subscriptions.lesson_id = lessons.id WHERE student_id=$userID");
                    $all_lessons = mysqli_query($conn,$unsubed_lessons);
                
                    //use a while loop to fetch the data and individually display as an option
                    while($lesson = mysqli_fetch_array($all_lessons,MYSQLI_ASSOC)):;
                    ?>
                    <option value="<?php echo $lesson["id"];?>">
                        <?php
                        //to show the category name to the user
                        echo $lesson["name"];
                        ?>
                    </option>
                    <?php
                        //while must be terminated
                        endwhile;
                    ?>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </div>
        </form>
        </div>
    </div>
</div>



<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Student
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#lessonAddModal">
                            Subscribe
                        </button>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Teacher Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../connect.php';

                            $query = ("SELECT * FROM lessons INNER JOIN subscriptions ON lessons.id = subscriptions.lesson_id WHERE subscriptions.student_id = $userID;");
                            $query_run = mysqli_query($conn, $query);


                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $mylesson)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $mylesson['name'] ?></td>
                                        <td><?= $mylesson['course'] ?></td>
                                        <td>
                                            <button type="button" name="viewlesson<?php $mylesson['lesson_id'];?>" value="<?=$mylesson['lesson_id'];?>" class="viewLessonBtn btn btn-info btn-sm">View</button>
                                            <button type="button" value="<?=$mylesson['id'];?>" class="deleteLessonBtn btn btn-danger btn-sm">Un-subscribe</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="js/myscripts.js"></script> 

</body>
</html>