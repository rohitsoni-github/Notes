<?php
$server="localhost";
$username="root";
$password="";
$dbname="rohit";
$update=false;
$delete=false;


$conn=new mysqli($server,$username,$password,$dbname);

if($conn->connect_error){
    die("connection failed due to ".$conn->connect_error );
}
/*else{
    echo "connected successfully";
    }*/
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
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
                <a class="nav-link " aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active " href="output.php">Notes</a>
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
      if($update){
        echo '<div class="alert alert-success" role="alert">Your Note Updated Successfully... </div>'; 
      }
      if($delete){
        echo '<div class="alert alert-success" role="alert">Your Note Deleted Successfully... </div>'; 
      }
      
      ?>
    
    <!--Table-->
    <div class="container" style="margin-top : 60px">
    <h2 style="margin-top:20px;margin-bottom:20px;margin-left:550px">Your Notes</h2><br>
        <table  class="table table-striped">
            <thead class="table-dark">
              <tr>
                <th scope="col"style="Width:5%">SNo.</th>
                <th scope="col"style="Width:20%">Title</th>
                <th scope="col" style="Width:60%">Description</th>
                <th scope="col"style="Width:11%"></th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $sql = "SELECT * FROM `notes`";
              $result = $conn->query($sql);
              $num = 1;
             // $row = $result->fetch_assoc();
              
              while($row= $result->fetch_assoc()){
                  echo ' <tr>
                  <th scope="row">'.$num.'</th>
                  <td>'.$row["title"].'</td>
                  <td>'.$row["desc"].'</td>
                  <td><button type="button" data-bs-target="#mymodal" data-bs-toggle="modal" id='.$row["Sno"].' class="edit btn btn-primary">Edit</button>
                  <button type="button" id=d'.$row["Sno"].' class="delete btn btn-primary">Delete</button></td>
                </tr>';
                $num = $num + 1;
              }
              ?>
             
              
            </tbody>
          </table>
      </div>
      <!--modal-->
    <div class="modal" id="mymodal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Note</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="output.php" method="POST">
                      <input type="hidden" name="snoedit" id="snoedit">
                      <div class="mb-3">
                      <label for="titleedit" style="font-size:larger;" class="form-label">Title</label>
                      <input type="text" class="form-control" style="padding:10px;border:2px solid black" id="titleedit" name="titleedit">
                      </div>
                      <div class="mb-3">
                      <label for="descedit" class="form-label" style="font-size:larger;">Description</label>
                      <textarea class="form-control" id="descedit" style="padding:10px;border:2px solid black" name="descedit" rows="3"></textarea>
                      </div>
                
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
            </div></form>
          </div>
        </div>
      </div>

      
      <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
          $esno = $_POST["snoedit"];
          $etitle = $_POST["titleedit"];
          $edesc = $_POST["descedit"];

          $sql = "UPDATE `notes` SET `title`='$etitle' , `desc`='$edesc' WHERE `notes`.`Sno`='$esno'";

          $done = $conn->query($sql);

         if($done){
          $update = true;
         }

        }

        if(isset($_GET["delete"])){
          $sno = $_GET["delete"];

          $sql = "DELETE FROM `notes` WHERE `Sno`='$sno'";

          $done = $conn->query($sql);

         if($done){
          $delete = true;
         }

        }
      ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          tr = e.target.parentNode.parentNode;
          title = tr.getElementsByTagName("td")[0].innerText;
          desc = tr.getElementsByTagName("td")[1].innerText;
          titleedit.value = title;
          descedit.value = desc;
          snoedit.value = e.target.id;
          $("#mymodal").modal("toggle");
          console.log(title,desc.target.id);
        })
        })

          deletes = document.getElementsByClassName('delete');
          Array.from(deletes).forEach((element)=>{
          element.addEventListener("click",(e)=>{
          sno = e.target.id.substr(1,);
          if(confirm("DO you really want to delete")){
            console.log("yes");
            window.location.assign("http://localhost/Notes/output.php?delete="+sno);
          }
          else{
          console.log("no");
          }
        })
        })
    </script>
  </body>
</html>

