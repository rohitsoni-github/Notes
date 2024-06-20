<?php
$server="localhost";
$username="root";
$password="";
$dbname="rohit";
$insert=false;

$conn=new mysqli($server,$username,$password,$dbname);

if($conn->connect_error){
    die("connection failed due to ".$conn->connect_error );
}
/*else{
    echo "connected successfully";
    }*/
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $title = $_POST["title"];
    $desc = $_POST["desc"];

    $sql = "INSERT INTO `notes`( `title`, `desc`) VALUES ('$title','$desc')";

    if($conn->query($sql)){
      $insert=true;
    }
   
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body >
  <img src="back.jpg" alt="1234" style="position:absolute;width:1520px;height:800px;z-index:-3">
  <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">i-Notes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="output.php">Notes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="#">Contact</a>
              </li>
              
            </ul>
  
          </div>
        </div>
      </nav>
      <?php 
      if($insert){
        echo '<div class="alert alert-success" role="alert">Your Note Created Successfully... </div>'; 
      }
      ?>
      <!--Note creation-->
      <form action="index.php" method="POST">
    <div class="container" style="margin-top: 60px;padding:25px;margin-left:390px;max-width:750px">
        <h3 style="margin-top:20px;margin-bottom:20px;margin-left:250px">Create a Note</h3>
        <div class="mb-3">
            <label for="title" style="font-size:larger;" class="form-label">Title</label>
            <input type="text" class="form-control" style="padding:10px;border:2px solid black;max-width:700px" id="title" name="title">
            </div>
            <div class="mb-3">
            <label for="desc" class="form-label" style="font-size:larger;">Description</label>
            <textarea class="form-control" id="desc" style="padding:10px;border:2px solid black;max-width:700px" name="desc" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="padding:10px;margin-top:20px;margin-left:280px">Create Note</button></form>
    </div><br><br><br>
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>