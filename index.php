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
        input[type=button]{
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Name:<br>
        <input type="text" id="name" required><br>
        Password:<br>
        <input type="password" id="password" required><br>
        Patron ID:<br>
        <input type="number" id="id" required><br>
        Email confirmation:
        <input type="checkbox" id="emailConf" onclick="toggleEmail(this)"><br>
        Email:<br>
        <input type="text" id="email" readonly><br><br>
        <select id="transactionType">
            <option value="schedule">Schedule an Appointment</option>
            <option value="cancel">Cancel an Appointment</option>
            <option value="search">Search for Appointment(s)</option>
            <option value="register">Register/Create an Account</option>
        </select><br><br>
        <input type="button" id="submit" value="Continue" onclick="validate()"><br>
    </form>

    <p>
        <a href="https://validator.w3.org/check/referer"><img src="https://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0!" height="31" width="88" /></a>
    </p>
</body>
</html>