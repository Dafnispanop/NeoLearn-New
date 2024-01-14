<?php
    require '../connect.php';

    session_start();

        // Έλεγχος αν ο χρήστης είναι συνδεδεμένος
        if (!isset($_SESSION['id'])) {
            header("Location: ../Login/login.php");
            exit();
    }

    $teacher_id= $_SESSION['id'];
    //Check if the file is uploaded
    $sql_lessons = ("SELECT * FROM lessons WHERE teacher_id='$teacher_id'");
    $all_lessons = mysqli_query($conn,$sql_lessons);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Teacher</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!-- Teacher Navbar -->

<header>    

<nav>
    <ul class="nav__links">
        <li><a href="teacher.php">MyLessons</a></li>
        <li><a href="teacherpdf.php">MyPDFS</a></li>
    </ul>
</nav>
<a class="cta" href="#"><button>Disconnect</button></a>
</header>






<!-- Add Lesson -->
<div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Lesson</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveVideo">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Url</label>
                    <input type="text" name="url" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Week</label>
                    <input type="number" name="week" class="form-control" min="1" max="13" />
                </div>
                <div class="mb-3">
                    <label for="">Lesson</label>
                    <select name="lesson" id="select_lesson">
                    <?php
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
                <button type="submit" class="btn btn-primary">Upload Video</button>
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
                    <h4>Upload/Delete Videos
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#studentAddModal">
                            Upload
                        </button>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Lesson ID</th>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Week</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../connect.php';

                            $query = "SELECT * FROM videos";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $video)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $video['id'] ?></td>
                                        <td><?= $video['lesson_id'] ?></td>
                                        <td><?= $video['name'] ?></td>
                                        <td><?= $video['location'] ?></td>
                                        <td><?= $video['week'] ?></td>
                                        <td>
                                            <button type="button" value="<?=$video['id'];?>" class="deleteVideoBtn btn btn-danger btn-sm">Delete</button>
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