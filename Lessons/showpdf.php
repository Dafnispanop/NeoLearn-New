<?php
    require '../connect.php';
    //Check if the file is uploaded
    // $teacher_id = 1;
    // $sql_lessons = ("SELECT * FROM lessons WHERE teacher_id='$teacher_id'");
    // $all_lessons = mysqli_query($con,$sql_lessons);

    if(isset($_POST['submit'])){
        //Gets the name of the selected lesson from the dropdown list, only if the submit is pressed
        $lesson_id = $_POST['Lesson'];
        //the name of the file in the database
        $name = $_POST['name'];
        
        $week = $_POST['Semester'];
        
        $img=$_FILES["pdfFile"]["name"];
        $targetDir = "images/";
        $targetFile = $targetDir . basename($_FILES["pdfFile"]["name"]);
        $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        // Check if file is a PDF and less than 20MB
        if($fileType != "pdf" || $_FILES["pdfFile"]["size"] > 20000000){
            echo "Error: only pdf files less than 20MB allowed to upload";
        }else{
            //Move uploaded file to images folder
            if(move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)){
                $folder_path = $targetDir;
                $sql = "INSERT INTO pdfs (lesson_id,teacher_id,name,img,week) 
                VALUES ('$lesson_id','$teacher_id', '$name', '$img' ,$week)";

                if($con->query($sql) === TRUE && !empty($name)){
                    //echo "File uploaded succesfully.";
                }else{
                    //echo "Error" . $sql . "<br>" . $conn->error;
                }
            }else{
                echo "Error uploading file";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Handle PDF</title>
</head>
<body>


<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pdfs</h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Lesson ID</th>
                                <th>Teacher ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Week</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../connect.php';
                            
                            if(isset($_GET['lessonid']) && isset($_GET['weekno'])){
                                $somevar = $_GET["lessonid"];
                                $anothervar = $_GET["weekno"];
                            }


                            $query = "SELECT * FROM pdfs WHERE lesson_id='$somevar' AND week='$anothervar'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $pdf){
                                    $file_path = "images/" . $pdf['img'];
                                    ?>
                                    <tr>
                                        <td><?= $pdf['id'] ?></td>
                                        <td><?= $pdf['lesson_id'] ?></td>
                                        <td><?= $pdf['teacher_id'] ?></td>
                                        <td><?= $pdf['name'] ?></td>
                                        <td><?= $pdf['img'] ?></td>
                                        <td><?= $pdf['week'] ?></td>
                                        <td>
                                            <a href="<?php echo $file_path;?>" class="btn btn-primary">View </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else{
                                echo "No Pdfs found";
                            }
                            ?>
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="js/myscripts.js"></script> 

    
</body>
</html>