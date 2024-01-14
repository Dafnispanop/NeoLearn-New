<?php
    require '../connect.php';
    //Check if the file is uploaded
    session_start();

    // Έλεγχος αν ο χρήστης είναι συνδεδεμένος
    if (!isset($_SESSION['id'])) {
        header("Location: ../Login/login.php");
        exit();
    }

    $teacher_id = $_SESSION['id'];
    $sql_lessons = ("SELECT * FROM lessons WHERE teacher_id='$teacher_id'");
    $all_lessons = mysqli_query($conn,$sql_lessons);

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

                if($conn->query($sql) === TRUE && !empty($name)){
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

    <h1>UPLOAD PDF</h1>
    
    
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">

                <form method="post" enctype="multipart/form-data">

                    <!-- The following drop down list is to automatically select a lesson that the user has created and the to upload a pdf to the selected lesson. -->
                    <label>Select a Lesson:</label>
                    <select name="Lesson" id="select_lesson">
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
                    <br>
                        <!-- The following dropdown list is to choose an week to upload the pdf file to -->
                    <label>Select a week:</label>
                    <select name="Semester" id="select_semester">
                        <?php
                        $range = range(1,13);
                        foreach ($range as $week) {
                        echo "<option value='$week'>$week </option>";
                        }
                        ?>
                    </select>
                    <br>
                    <label>File name</label>
                    <input type="text" name="name">
                    <br>
                    <label for="pdfFile">Select a PDF File:</label>
                    <input type="file" name="pdfFile" id="pdfFile">
                    <br>
                    <button type="submit" name="submit">UPLOAD</button>
                </form>



                </div>
            </div>
        </div>
    </div>
</div>


    <div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Delete Lessons AJAx</h4>
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
                            //$teacher_id= 2;
                            $query = "SELECT * FROM pdfs WHERE teacher_id='$teacher_id'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $pdf)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $pdf['id'] ?></td>
                                        <td><?= $pdf['lesson_id'] ?></td>
                                        <td><?= $pdf['teacher_id'] ?></td>
                                        <td><?= $pdf['name'] ?></td>
                                        <td><?= $pdf['img'] ?></td>
                                        <td><?= $pdf['week'] ?></td>
                                        <td>
                                            <button type="button" value="<?=$pdf['id'];?>" class="deletePdfBtn btn btn-danger btn-sm">Delete</button>
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="js/myscripts.js"></script> 

    
</body>
</html>