<?php
    include("config.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form
        $myusername = $_POST['name'];
        $mypassword = $_POST['password'];

        $_SESSION['email'] = $_POST['email'];
        $_SESSION['id'] = $_POST['id'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['password'] = $_POST['password'];

        $sql = "SELECT ID FROM IT202_Patient WHERE Patient_Name = '$myusername' and Password = '$mypassword'";
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row

        if($count == 1) {
            $_SESSION['login_user'] = $_POST['name'];
            if($_POST['transactionType']=="schedule"){
                header("location: schedule.php");
                exit;
            }
            elseif($_POST['transactionType']=="cancel"){
                header("location: cancel.php");
                exit;
            }
            elseif($_POST['transactionType']=="search"){
                header("location: it202assignment4result.php");
                exit;
            }
            elseif($_POST['transactionType']=="register"){
                print("User already exists!<br>");
            }
        }
        elseif($_POST['transactionType']=="register"){
            header("location: register.php");
            exit;
        }
        else {
            print("Your Login Name or Password is invalid");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smiles Galore Login</title>
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
        input[type=submit]{
            background-color: #80ecee;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        #email{
            color: gray;
            background-color: #cdcdcd;
        }
    </style>
</head>
<body>
    <form id="form" onsubmit="return validate(this)" action="index.php" method="post">
        Name:<br>
        <input type="text" id="name" name="name" value="Shaunna Carr" required><br>
        Password:<br>
        <input type="password" id="password" name="password" maxlength="8" value="8hJJeX92" required><br>
        Patron ID:<br>
        <input type="number" id="id" size="8" name="id" value="10000001" required><br>
        Email confirmation:
        <input type="checkbox" id="emailConf" name="emailConf" onclick="toggleEmail(this)"><br>
        Email:<br>
        <input type="text" id="email" name="email" readonly><br><br>
        <select id="transactionType" name="transactionType">
            <option value="schedule">Schedule an Appointment</option>
            <option value="cancel">Cancel an Appointment</option>
            <option value="search">Search for Appointment(s)</option>
            <option value="register">Register/Create an Account</option>
        </select><br><br>
        <input type="submit" id="submit" name="submit" value="Continue"><br>
    </form>

    <p>
        <a href="https://validator.w3.org/check/referer"><img src="https://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0!" height="31" width="88" /></a>
    </p>
</body>
</html>