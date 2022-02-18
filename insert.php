<?php 
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="insert.php" method="POST">
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
        <input type="text" name="" class="form-control" id="exampleInputPassword1" placeholder="photo">
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

<?php 
    if (isset($_POST['submit'])) {
      $matricule = $_POST['matricule'];
      $nom = $_POST['nom'];
      $prénom = $_POST['prénom'];
      $date = $_POST['date_naissance'];
      $département = $_POST['département'];
      $salaire = $_POST['salaire'];
      $fonction = $_POST['fonction'];
        
      // insert records into database
      $sql = "INSERT INTO employe (matricule, nom, prénom, date, département, salaire, fonction)
      VALUES ('$matricule','$nom','$prénom', '$date', '$département', '$salaire', '$fonction')";
      
      // excute query 
      if (mysqli_query($conn, $sql)) {
          echo "New line has been added";
      } else {
          echo "Error: " . $sql . ":-" . mysqli_error($conn);
      }
      mysqli_close($conn);
  }
?>
</body>
</html>
