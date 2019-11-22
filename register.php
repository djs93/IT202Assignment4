<head>
    <meta charset="UTF-8">
    <title>Smiles Galore Registration</title>
    <script src="script.js"></script>
    <style>
        body{
            text-align: center;
        }
        input[type=text],input[type=password],input[type=number],select{
            margin: 8px 0;
            padding: 14px 20px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            background-color: #80ecee;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        td, th {border: thin solid black;}
        table {
            alignment: center;
            border: thin solid black;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<?php
session_start();
include("config.php");
$email = $_SESSION['email'];
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$password = $_SESSION['password'];
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //make sure user doesn't already exist (email and ID)
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['id'] = $_POST['id'];
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['password']  = $_POST['password'];

    $email = $_POST['email'];
    $id = $_POST['id'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    $query = "SELECT * from IT202_Patient where Email=$email";
    $res1 = mysqli_query($db, $query);
    $countName = mysqli_num_rows($res1);

    $query = "SELECT * from IT202_Patient where ID=$id";
    $res2 = mysqli_query($db, $query);
    $countID = mysqli_num_rows($res2);
    if($countName>0){
        print("Email already in system!<br>");
    }
    else if($countID>0){
        print("ID already in system!<br>");
    }
    else{
        print("<h1>Account Creation Successful!</h1>");
        $query = "SELECT * from IT202_Patient where ID=$id";
        $result = mysqli_query($db, $query);
        $beforeCount = mysqli_num_rows($result);
        print("Rows before insertion: $beforeCount<br>");
        printTable($result);

        $query = "INSERT INTO IT202_Patient(ID, Patient_Name, Password, Email) VALUES ('$id', '$name', '$password', '$email')";
        mysqli_query($db, $query);
        print(mysqli_error($db));

        $query = "SELECT * from IT202_Patient where ID=$id";
        $result = mysqli_query($db, $query);
        $afterCount = mysqli_num_rows(mysqli_query($db, $query));


        print("<br>Rows after insertion: $afterCount<br>");
        printTable($result);

        //store number of users in db before
        //insert user into database
        //store number after
        //grab table row
        //print num before
        //print num after
        //print table row
        exit;
    }


}
?>
<form id="form" onsubmit="return validate_registration(this)" action="" method="post">
    Name:<br>
    <input type="text" id="name" name="name" value="<?php print($name);?>" required><br>
    Password:<br>
    <input type="password" id="password" name="password" maxlength="8" value="<?php print($password);?>" required><br>
    Patron ID:<br>
    <input type="number" id="id" size="8" name="id" value="<?php print($id);?>" required><br>
    Email:<br>
    <input type="text" id="email" name="email" value="<?php print($email);?>" required><br><br>
    <input type="submit" id="submit" name="submit" value="Register"><br>
</form>

<p>
    <a href="https://validator.w3.org/check/referer"><img src="https://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0!" height="31" width="88" /></a>
</p>
</body>