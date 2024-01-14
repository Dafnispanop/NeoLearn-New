<?php
    require '../connect.php';
    session_start();

    // Έλεγχος αν ο χρήστης είναι συνδεδεμένος
    if (!isset($_SESSION['id'])) {
        header("Location: ../Login/login.php");
        exit();
    }

    // Λήψη των λεπτομερειών του συνδεδεμένου χρήστη
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $result = $conn->query($sql);
    //Check if the file is uploaded
    //this is a regular yt url
    $videoURL = "https://www.youtube.com/watch?v=aPUVUrS2oC0";
    // this is an embeded yt url 
    $converted = str_replace("watch?v=","embed/",$videoURL);
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
        <li><a href="showlessons.php">MyLessons</a></li>
    </ul>
</nav>
<a class="cta" href="#"><button>Disconnect</button></a>
</header>



<!-- url copy paste does not work, only from embed youtube feature -->
<div class="col-lg-12">
    <form>
        <div class="form-group">
            <input class="form-control url" placeholder="Paste the url from the links below" />
        </div>
        <div class="form-group">
            <button class="btn btn-success">Show video</button>
        </div>
    </form>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" width="560" height="315" src=" <?php echo $converted; ?> " title="YouTube video player" 
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Show Videos

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

                            if(isset($_GET['lessonid']) && isset($_GET['weekno'])){
                                $somevar = $_GET["lessonid"];
                                $anothervar = $_GET["weekno"];
                            }


                            $query = "SELECT * FROM videos WHERE lesson_id='$somevar' AND week='$anothervar'";
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
                                    </tr>
                                    <?php
                                }
                            }
                            else{
                                echo "No Videos found";
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
    <script src="js/showvids.js" defer></script>

    







</body>
</html>