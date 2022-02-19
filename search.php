<?php include 'connect.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <title>Document</title>
</head>
<body>
    <form action="search.php" method="POST">
        <select name="search_select">
            <option value="matricule">matricule</option>
            <option value="nom">nom</option>
            <option value="département">departement</option>
        </select>
        <input type="text" name="input">
        <input type="submit" name="search_btn">
    </form>
    <table class='table table-striped'>
        <thead>
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
        </thead>
        <tbody>
            <?php
                if(isset($_POST["search_btn"])){
                    $search_select = $_POST["search_select"];
                    $input = $_POST["input"];
                    $SQL = "SELECT * FROM employe
                    WHERE $search_select LIKE '%$input%';";
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
                }
            ?>
        </tbody>

    </table>
</body>
</html>