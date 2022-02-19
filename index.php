<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="search.html">Search</a>
          </li>
          <li class="nav-item dropdown">
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <form action="index.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <input type="text" name="matricule" class="form-control" id="exampleInputEmail1"  placeholder="matricule">
    </div>
    <div class="mb-3">
      <input type="text" name="nom" class="form-control" id="exampleInputPassword1" placeholder="nom">
    </div>
    <div class="mb-3">
    <input type="text"  name="prénom" class="form-control" id="exampleInputPassword1" placeholder="prénom">
    </div>
    <div class="mb-3 ">
    <input type="date" name="date_naissance" class="form-control" id="exampleInputPassword1" placeholder="date">
    </div>
    <div class="mb-3 ">
    <input type="text" name="département" class="form-control" id="exampleInputPassword1" placeholder="département">
    </div>
    <div class="mb-3 ">
    <input type="number" name="salaire" class="form-control" id="exampleInputPassword1" placeholder="salaire">
    </div>
    <div class="mb-3 ">
    <input type="text" name="fonction" class="form-control" id="exampleInputPassword1" placeholder="fonction">
    </div>
    <div class="mb-3 ">
    <input type="file" name="uploadphoto" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" name="submit" class="btn btn-dark">Submit</button>

  </form>
      <table class="table table-striped">
          <tr>
              <th>matricule</th>
              <th>nom</th>
              <th>prénom</th>
              <th>date_naissance</th>
              <th>département</th>
              <th>salaire</th>
              <th>fonction</th>
              <th>Photo</th>
              <th>setting</th>
          </tr>
          <?php
            if (isset($_POST['submit'])) {
              $matricule = $_POST['matricule'];
              $nom = $_POST['nom'];
              $prénom = $_POST['prénom'];
              $date = $_POST['date_naissance'];
              $département = $_POST['département'];
              $salaire = $_POST['salaire'];
              $fonction = $_POST['fonction'];

              $photoname = $_FILES["uploadphoto"]["name"];
              $temp_name = $_FILES["uploadphoto"]["tmp_name"];
              $file = "photos/" . $photoname;
                
              // insert records into database
              $sql = "INSERT INTO employe (matricule, nom, prénom, date, département, salaire, fonction, photo)
              VALUES ('$matricule','$nom','$prénom', '$date', '$département', '$salaire', '$fonction', '$photoname')";

              // move photo to folder
              if(move_uploaded_file($temp_name, $file)){
                $mssg = "yes";
              }
              else{
                $mssg = "no";
              }
              // excute query 
              if (mysqli_query($conn, $sql)) {
                  echo "New line has been added";
              } else {
                  echo "Error: " . $sql . ":-" . mysqli_error($conn);
              }
          }


          if(isset($_GET['matr'])){
            $matricule = $_GET['matr'];
            $query = "DELETE FROM employe WHERE matricule = '$matricule'";
            $data = mysqli_query($conn, $query);

            if($data){
              echo "deleted";
            }
            else{
              echo "not deleted";
            }
          }
          // show records from database in table 
          
            $SQL = "SELECT * FROM employe;";
            $result = mysqli_query($conn, $SQL);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0){
              while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                <td>".$row["matricule"]."</td>
                <td>".$row["nom"]."</td>
                <td>".$row["prénom"]."</td>
                <td>".$row["date"]."</td>
                <td>".$row["département"]."</td>
                <td>".$row["salaire"]."</td>
                <td>".$row["fonction"]."</td>
                <td> <img src='photos/" . $row["photo"]. "'></td>
                <td><a href='index.php?matr=$row[matricule]' onClick=\"return confirm('are you sure you want to delete this record ?')\"><img class='icone' src='trash.png'></a>
                    <a href='edit.php?matr=$row[matricule]& pic=$row[photo]'> <img class='icone' src='editing.png'></a>

                </td>

              
                </tr>";
                  
              }
            }
          
          ?>
        </table>
</body>
</html>