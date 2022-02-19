<?php 
  include "connect.php";
  $matr = $_GET['matr'];
  $photo = $_GET['pic'];
  $sql_select = "SELECT * FROM employe WHERE matricule ='$matr'"; 
  $result = $conn->query($sql_select);
  $row = $result->fetch_array(MYSQLI_ASSOC);
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
<form action="edit.php?matr=<?php echo $matr ."&pic=$photo"?>" method="POST" enctype="multipart/form-data">
   
    <div class="mb-3">
      <input type="text" name="nom" value="<?php echo $row["nom"] ?>" class="form-control" id="exampleInputPassword1" placeholder="nom">
    </div>
    <div class="mb-3">
    <input type="text"  name="prénom" value="<?php echo $row["prénom"] ?>" class="form-control" id="exampleInputPassword1" placeholder="prénom">
    </div>
    <div class="mb-3 ">
    <input type="date" name="date" value="<?php echo $row["date"] ?>" class="form-control" id="exampleInputPassword1" placeholder="date">
    </div>
    <div class="mb-3 ">
    <input type="text" name="département" value="<?php echo $row["département"] ?>" class="form-control" id="exampleInputPassword1" placeholder="département">
    </div>
    <div class="mb-3 ">
    <input type="number" name="salaire" value="<?php echo $row["salaire"] ?>" class="form-control" id="exampleInputPassword1" placeholder="salaire">
    </div>
    <div class="mb-3 ">
    <input type="text" name="fonction" value="<?php echo $row["fonction"] ?>" class="form-control" id="exampleInputPassword1" placeholder="fonction">
    </div>
    <div class="mb-3 ">
    <img src="photos/<?php echo $row["photo"];?>" alt="ok">
    <input type="file" name="uploadphoto" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" name="edit" class="btn btn-dark">SAVE</button>

  </form>
</body>
</html>

<?php 

if (isset($_POST['edit'])) {
    $nom = $_POST['nom'];
    $prénom = $_POST['prénom'];
    $date = $_POST['date'];
    $département = $_POST['département'];
    $salaire = $_POST['salaire'];
    $fonction = $_POST['fonction'];
    $photoname = $_FILES["uploadphoto"]["name"];
    $temp_name = $_FILES["uploadphoto"]["tmp_name"];
    $file = "photos/" . $photoname;
      
    // update records 
    $update_sql =  "UPDATE employe
        SET nom='$nom', prénom='$prénom', date='$date', département='$département', salaire=$salaire, fonction='$fonction', photo='$photoname'
         WHERE matricule='$matr'";
        echo $update_sql;

    // move photo to folder
    move_uploaded_file($temp_name, $file);
    
    // excute query 
    if (mysqli_query($conn, $update_sql)) {
        echo "New line has been added";
        header("location: index.php");
    } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
    }
}

?>