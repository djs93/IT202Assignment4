<?php
    define('DB_SERVER', "sql1.njit.edu");
    define('DB_USERNAME', 'djs93');
    define('DB_PASSWORD', 'MmauH0Ak');
    define('DB_DATABASE', 'djs93');
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    function printTable($result){
        print "<table>";
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
        print "</table>";
    }