<head>
    <meta charset="UTF-8">
    <title>Smiles Galore Appointment Cancel</title>
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
//Job_ID, Patient_Name, Procedure_Name, Dentist_Name, Time
include("config.php");
session_start();
$id = $_SESSION['id'];
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "SELECT IT202_Patient_Procedures.Job_ID, IT202_Patient.Patient_Name, IT202_Procedure_Names.Procedure_Name, IT202_Dentist_Names.Dentist_Name, IT202_Patient_Procedures.Time
                            FROM IT202_Patient_Procedures
                            INNER JOIN IT202_Patient ON IT202_Patient_Procedures.Patient_ID=IT202_Patient.ID
                            INNER JOIN IT202_Dentist_Names ON IT202_Patient_Procedures.Dentist=IT202_Dentist_Names.ID
                            INNER JOIN IT202_Procedure_Names ON IT202_Patient_Procedures.ProcedureType=IT202_Procedure_Names.Procedure_ID
                            WHERE Patient_ID = '$id'
                            ORDER BY IT202_Patient_Procedures.Time ASC";
    $result = mysqli_query($db, $query);
    $beforeCount = mysqli_num_rows($result);
    print("Rows before insertion: $beforeCount<br>");
    printTable($result);

    $job = $_POST['jobToDel'];
    $query = "DELETE FROM IT202_Patient_Procedures WHERE IT202_Patient_Procedures.Job_ID = $job";
    mysqli_query($db, $query);
    print(mysqli_error($db));

    $query = "SELECT IT202_Patient_Procedures.Job_ID, IT202_Patient.Patient_Name, IT202_Procedure_Names.Procedure_Name, IT202_Dentist_Names.Dentist_Name, IT202_Patient_Procedures.Time
                            FROM IT202_Patient_Procedures
                            INNER JOIN IT202_Patient ON IT202_Patient_Procedures.Patient_ID=IT202_Patient.ID
                            INNER JOIN IT202_Dentist_Names ON IT202_Patient_Procedures.Dentist=IT202_Dentist_Names.ID
                            INNER JOIN IT202_Procedure_Names ON IT202_Patient_Procedures.ProcedureType=IT202_Procedure_Names.Procedure_ID
                            WHERE Patient_ID = '$id'
                            ORDER BY IT202_Patient_Procedures.Time ASC";
    $result = mysqli_query($db, $query);
    $afterCount = mysqli_num_rows(mysqli_query($db, $query));


    print("<br>Rows after insertion: $afterCount<br>");
    printTable($result);
    exit;
}
?>
    <form method="post">
        <table>
            <?php
                $query = "SELECT IT202_Patient_Procedures.Job_ID, IT202_Patient.Patient_Name, IT202_Procedure_Names.Procedure_Name, IT202_Dentist_Names.Dentist_Name, IT202_Patient_Procedures.Time
                            FROM IT202_Patient_Procedures
                            INNER JOIN IT202_Patient ON IT202_Patient_Procedures.Patient_ID=IT202_Patient.ID
                            INNER JOIN IT202_Dentist_Names ON IT202_Patient_Procedures.Dentist=IT202_Dentist_Names.ID
                            INNER JOIN IT202_Procedure_Names ON IT202_Patient_Procedures.ProcedureType=IT202_Procedure_Names.Procedure_ID
                            WHERE Patient_ID = '$id'
                            ORDER BY IT202_Patient_Procedures.Time ASC";
                $result = mysqli_query($db, $query);
                if (!$result) {
                    print "Error - the query could not be executed";
                }
                print "<tr align = 'center'>";
                $num_rows = mysqli_num_rows($result);
                if ($num_rows > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $num_fields = mysqli_num_fields($result);// Produce the column labels
                    $keys = array_keys($row);
                    print "<th></th>";
                    for ($index = 0; $index < $num_fields; $index++)
                        print "<th>" . $keys[$index] . "</th>";
                    print "</tr>";// Output the values of the fields in the rows
                    for ($row_num = 0; $row_num < $num_rows; $row_num++) {
                        print "<tr>";
                        $values = array_values($row);
                        $jobID = htmlspecialchars($values[0]);
                        print("<td><input type='radio' name='jobToDel' value='$jobID' required></td>");
                        for ($index = 0; $index < $num_fields; $index++) {
                            $value = htmlspecialchars($values[$index]);
                            print "<td>" . $value . "</td>";
                        }
                        print "</tr>";
                        $row = mysqli_fetch_assoc($result);
                    }
                }
                else {
                    print "There were no such rows in the table <br />";
                }
            ?>
        </table>
        <label>
            <input type="submit" value="Delete">
        </label>
    </form>
</body>
