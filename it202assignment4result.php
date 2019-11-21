<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data results</title>
    <style type="text/css">
        td, th, table {border: thin solid black;}
    </style>
</head>
<body>
<?php
    session_start();
    $myname = $_SESSION['login_user'];
    function writeQueryTable($db, $query, $tableTitle){
        $result = mysqli_query($db, $query);
        if (!$result) {
            print "Error - the query could not be executed";
        }
        print "<table><caption> <h2> $tableTitle </h2> </caption>";
        print "<tr align = 'center'>";
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $num_fields = mysqli_num_fields($result);// Produce the column labels
            $keys = array_keys($row);
            for ($index = 0; $index < $num_fields; $index++)
                print "<th>" . $keys[$index] . "</th>";
            print "</tr>";// Output the values of the fields in the rows
            for ($row_num = 0; $row_num < $num_rows; $row_num++) {
                print "<tr>";
                $values = array_values($row);
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
        print "</table>";
    }
    $db = mysqli_connect("sql1.njit.edu", "djs93", "MmauH0Ak", "djs93");
    $query = "SELECT IT202_Patient.ID, IT202_Patient.Patient_Name, IT202_Patient.Password, IT202_Patient.Email, IT202_Procedure_Names.Procedure_Name, IT202_Dentist_Names.Dentist_Name, IT202_Patient_Procedures.Time, IT202_Patient_Procedures.Job_ID
    FROM IT202_Patient_Procedures
    INNER JOIN IT202_Patient ON IT202_Patient_Procedures.Patient_ID=IT202_Patient.ID
    INNER JOIN IT202_Dentist_Names ON IT202_Patient_Procedures.Dentist=IT202_Dentist_Names.ID
    INNER JOIN IT202_Procedure_Names ON IT202_Patient_Procedures.ProcedureType=IT202_Procedure_Names.Procedure_ID
    WHERE Patient_Name = '$myname'
    ORDER BY IT202_Patient_Procedures.Time ASC";
    writeQueryTable($db, $query, "Appointments");
?>
</body>
</html>