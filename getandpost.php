<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "test";

$conn = mysqli_connect("$hostname","$username","$password","$database");

if($conn){
    echo "Connection Successfull";
}
else{
    echo "error:". mysqli_connect_error();
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['employer_name'])){
        $selected_name = $_POST['employer_name'];

        // $sql1 = "INSERT INTO employer where first_name = ?";
        $stmt = $conn->prepare("insert into employer (first_name) values (?)");
        $stmt -> bind_param("s",$selected_name);

        if($stmt->execute()){
            echo "<script>alert('Successfully inserted');</script>";
        }else{
            echo "<script>alert('error:' ". $conn->error ." );</script>";
        }
        
    }
$stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form method="post">
            
            <label>Employer name</label>
            <select class="form-select" name="employer_name">
            <?php
            $sql = "Select first_name from employer;";
            $result = mysqli_query($conn,$sql);

            if($result->num_rows > 0){
                while($rows = $result->fetch_assoc()){
            
            ?>
                <option value="<?php echo $rows['first_name']; ?>"><?php echo $rows['first_name']; ?></option>
           

            <?php
            }
            }
            ?>
             </select>

             <div>
                <button type="submit" id="submit">Submit</button>
             </div>
        </form>
    </div>
</body>
</html>