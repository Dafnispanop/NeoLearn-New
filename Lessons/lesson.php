<?php
    session_start();
    require '../connect.php';
    //this variable must be a session variable
    $user_id=9;

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
</head>
<body>

<!-- Teacher Navbar -->

<header>    

<nav>
    <ul class="nav__links">
        <li><a href="showlessons.php">BACK</a></li>
    </ul>
</nav>
<a class="cta" href="#"><button>Disconnect</button></a>
</header>



<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Lesson PDFS: 
                        <?php 
                        if(isset($_GET['lessonid'])){
                            $somevar = $_GET["lessonid"];
                            echo $somevar;
                        }
                        ?>
                        
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>WEEKS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../connect.php';

                            $query = ("SELECT * FROM pdfs  WHERE lesson_id='$somevar'");
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                for($x=1; $x<=13; $x++)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo "Week number ".$x; ?></td>
                                        <td>
                                            <button type="button" value="<?=$x;?>" class="viewPdfBtn btn btn-info btn-sm">View</button>
                                            
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

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Lesson Videos: 
                        
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>WEEKS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../connect.php';

                            $query = ("SELECT * FROM pdfs  WHERE lesson_id='$somevar'");
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                for($x=1; $x<=13; $x++)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo "Week number ".$x; ?></td>
                                        <td>
                                            <button type="button" value="<?=$x;?>" class="viewVideoBtn btn btn-info btn-sm">View</button>
                                            
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