<head>
    <meta charset="UTF-8">
    <title>Smiles Galore Scheduling</title>
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
    include("config.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //Insert data as appointment
        //Match names to ids to insert
        $id = $_SESSION['id'];

        $procType = (int)$_POST['appointType']+1;

        $dentID = (int)$_POST['dentist']+1;

        $date = $_POST['date'];
        $time = $_POST['time'];

        $formattedDateTime = $date." ".$time.":00";

        $query = "SELECT * from IT202_Patient_Procedures where Patient_ID=$id";
        $result = mysqli_query($db, $query);
        $beforeCount = mysqli_num_rows($result);
        print("Rows before insertion: $beforeCount<br>");
        printTable($result);

        $query = "INSERT INTO IT202_Patient_Procedures(Patient_ID, ProcedureType, Dentist, Time) values ('$id', '$procType', '$dentID','$formattedDateTime')";
        mysqli_query($db, $query);
        print(mysqli_error($db));

        $query = "SELECT * from IT202_Patient_Procedures where Patient_ID=$id";
        $result = mysqli_query($db, $query);
        $afterCount = mysqli_num_rows(mysqli_query($db, $query));


        print("<br>Rows after insertion: $afterCount<br>");
        printTable($result);
        exit;
    }
    ?>
    <form method="post">
        <label>
            Date:
            <input type="date" id="date" name="date" required><br>
        </label>
        <label>
            Time:
            <input type="time" id="time" name="time" required><br>
        </label>
        <label>
            Appointment Type:
            <select id="appointType" name="appointType" required>
                <!--Do php population-->
                <?php
                //Procedure dropdown
                $query = "SELECT Procedure_Name from IT202_Procedure_Names";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
                if ($num_rows > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $keys = array_keys($row);
                    for ($row_num = 0; $row_num < $num_rows; $row_num++) {
                        print "<option value='$row_num'>";
                        $values = array_values($row);
                        $value = htmlspecialchars($values[0]);
                        print "$value";
                        print "</option>";
                        $row = mysqli_fetch_assoc($result);
                    }
                }
                //Get procedure entries from database
                //Populate dropdown selections with
                ?>
            </select><br>
        </label>
        <label>
            Dentist:
            <select id="dentist" name="dentist" required>
                <!--Do php population-->
                <?php
                $query = "SELECT Dentist_Name from IT202_Dentist_Names";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
                if ($num_rows > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $keys = array_keys($row);
                    for ($row_num = 0; $row_num < $num_rows; $row_num++) {
                        print "<option value='$row_num+1'>";
                        $values = array_values($row);
                        $value = htmlspecialchars($values[0]);
                        print "$value";
                        print "</option>";
                        $row = mysqli_fetch_assoc($result);
                    }
                }
                ?>
            </select><br>
        </label>
        <label>
            <input type="submit" value="Submit">
        </label>
    </form>
</body>
