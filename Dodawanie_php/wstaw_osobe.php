<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Formularz</title>
</head>
<body>
<div class="formularz">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <p>Imie:</p><input class="inp" type="text" name="name"><br>
    <p>Plec:</p> <br>  
    <input  type="radio" name="gender" value="mezczyzna"><label>Mezczyzna</label><br>
                
    <input  type="radio" name="gender" value="kobieta"><label>Kobieta</label><br>
            
    <p>Wiek:<p> <input class="inp" type="number" name="age"><br>
    <input class="buttonSub" type="submit" value="Kliknij aby dodac osobe"><br>
    <input class="buttonClear" type="reset" value="Zacznij na nowo">
</form>
</div>
</body>
</html>


<?php
include_once 'config.php';

    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    

    $sql = "CREATE TABLE IF NOT EXISTS osoby (id INT PRIMARY KEY AUTO_INCREMENT,name VARCHAR(25), gender VARCHAR(20),age INT);";

    $result1 = mysqli_query($conn,$sql);

    $sql0 = "INSERT INTO osoby (name, gender, age) VALUES ('$name', '$gender','$age')";

    if ($conn->query($sql0) === TRUE) {
        echo '<p class="conn">'."Rekord został dodany poprawnie.".'</p>';
    } else {
        echo "Błąd: " . $sql . "<br>" . $conn->error;
    }
    
    $sql2 = "SELECT * FROM osoby";
            
            $result = mysqli_query($conn,$sql2);
            
            echo "<table><tr><td>Wszystkie osoby</td></tr><tr><td>id</td><td>imie</td><td>plec</td><td>wiek</td></tr>";
            while($row = mysqli_fetch_array($result)){
                echo '<tr>'.'<td>'.$row['id'].'</td>'.'<td>'.$row['name'].'</td>'.'<td>'.$row['gender'].'</td>'.'<td>'.$row['age'].'</td>';
            }echo '<br>';
            

    $sql3 = "SELECT * FROM osoby WHERE gender='mezczyzna'";
            
            $result = mysqli_query($conn,$sql3);
            
            echo "<table><tr><td>Wszyscy mezczyzni</td></tr><tr><td>id</td><td>imie</td><td>plec</td><td>wiek</td></tr>";
            while($row = mysqli_fetch_array($result)){
                echo '<tr>'.'<td>'.$row['id'].'</td>'.'<td>'.$row['name'].'</td>'.'<td>'.$row['gender'].'</td>'.'<td>'.$row['age'].'</td>';
            }echo '<br>';
            

    $sql4 = "SELECT * FROM osoby WHERE age>=18";
            
            $result = mysqli_query($conn,$sql4);
            echo "<table><tr><td>Wszystkie osoby pelnoletnie</td></tr><tr><td>id</td><td>imie</td><td>plec</td><td>wiek</td></tr>";
            while($row = mysqli_fetch_array($result)){
                echo '<tr>'.'<td>'.$row['id'].'</td>'.'<td>'.$row['name'].'</td>'.'<td>'.$row['gender'].'</td>'.'<td>'.$row['age'].'</td>';
            }echo '<br>';
            

    $sql5 = "SELECT * FROM osoby WHERE age>=18 AND gender='kobieta'";
            
            $result = mysqli_query($conn,$sql5);
            echo "<table><tr><td>Wszystkie pelnoletnie kobiety</td></tr><tr><td>id</td><td>imie</td><td>plec</td><td>wiek</td></tr>";
            while($row = mysqli_fetch_array($result)){
                echo '<tr>'.'<td>'.$row['id'].'</td>'.'<td>'.$row['name'].'</td>'.'<td>'.$row['gender'].'</td>'.'<td>'.$row['age'].'</td>';
            }echo '<br>';
            

    $sql6 = "SELECT avg(age) FROM osoby";
            
            $result = mysqli_query($conn,$sql6);
            echo "<table><tr><td>Sredni wiek</td></tr>";
            while($row = mysqli_fetch_array($result)){
                echo '<tr>'.'<td>'.$row['0'].'</td>'.'</tr>';
            }echo '<br>';
            

    $sql7 = "SELECT avg(age) FROM osoby WHERE gender='mezczyzna'";
            
            $result = mysqli_query($conn,$sql7);
            echo "<table><tr><td>Sredni wiek mezczyzn</td></tr>";
            while($row = mysqli_fetch_array($result)){
                echo '<tr>'.'<td>'.$row['0'].'</td>'.'</tr>';
            }echo '<br>';
             

    $sql8 = "SELECT avg(age) FROM osoby WHERE gender='kobieta'";
            
            $result = mysqli_query($conn,$sql8);
            echo "<table><tr><td>sredni wiek kobiet</td></tr>";
            while($row = mysqli_fetch_array($result)){
                echo '<tr>'.'<td>'.$row['0'].'</td>'.'</tr>';
            }echo '<br>';
            

$conn->close();
?>

