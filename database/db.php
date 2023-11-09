<?php
$conexion = new PDO('mysql:host=db.fmesasc.com;dbname=daw2', 'daw2', 'Gimbernat');



// mostrar todos los valores de una tabla
// ShowAllColumns($conexion, 'dlf_cities');

// mostrar base de datos (nombre de tablas y sus columnas)
// ShowDatabase($conexion);




function addUser($conexion, $username, $password, $email) {
    try {
        $sql = "SELECT MAX(id) AS max_id FROM dlf_users";
        $stmt = $conexion->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $nextId = intval($result['max_id']) + 1;

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Create an array with user data
        $userData = [
            'id' => $nextId,
            'username' => $username,
            'password' => $hashedPassword,
            'email' => $email,
            'registerDate' => date("Y-m-d"),
            'isAdmin' => false
        ];

        // Prepare and execute the INSERT statement
        $sql = "INSERT INTO dlf_users (id, username, password, email, registerDate, isAdmin) 
            VALUES (:id, :username, :password, :email, :registerDate, :isAdmin)";

        $stmt = $conexion->prepare($sql);

        if ($stmt->execute($userData)) {
            echo "User successfully inserted <br>";
        } else {
            echo "Error inserting user: " . $stmt->errorInfo()[2] . "<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    /* Example usage
    $username = "NewUser";
    $password = "NewPassword";
    $email = "newuser@example.com";
    $assignedId = addUser($username, $password, $email, $conexion);
    echo "New user with ID: $assignedId added.";
    */

    /*
     $userData = [
        'id' => 1,
        'username' => 'Ariel',
        'password' => 'password',
        'email' => 'aalvaroc@campus.eug.es',
        'registerDay' => '1970-01-01',
        'isAdmin' => true
    ];

    $sql = "INSERT INTO dlf_users (id, username, password, email, registerDay, isAdmin) VALUES (:id, :username, :password, :email, :registerDay, :isAdmin)";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $userData['id']);
    $stmt->bindParam(':username', $userData['username']);
    $stmt->bindParam(':password', $userData['password']);
    $stmt->bindParam(':email', $userData['email']);
    $stmt->bindParam(':registerDay', $userData['registerDay']);
    $stmt->bindParam(':isAdmin', $userData['isAdmin']);

    $stmt->execute();
     */
}

function editUser($conexion, $userId, $newUsername, $newPassword, $newEmail) {
    try {
        // Hash the new password if provided
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Hashed password

        // Update the user's information in the dlf_users table
        $sql = "UPDATE dlf_users 
                SET username = :newUsername, password = :hashedPassword, email = :newEmail 
                WHERE id = :userId";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
        $stmt->bindParam(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':newEmail', $newEmail, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $affectedRows = $stmt->rowCount();

        if ($affectedRows > 0) {
            echo "User with ID $userId has been updated successfully.<br>";
            return true;
        } else {
            echo "User not found.<br>";
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    /* Usage example:
    $userId = 1; // Replace with the actual user's ID
    $newUsername = "NewUsername"; // Replace with the new username
    $newPassword = "NewPassword"; // Replace with the new password
    $newEmail = "newemail@example.com"; // Replace with the new email
    editUser($conexion, $userId, $newUsername, $newPassword, $newEmail);
     */
}

function checkUser($conexion, $email, $password) { //for login
    try {
        // Query to retrieve the user's information based on the email
        $sql = "SELECT id, email, password FROM dlf_users WHERE email = :email";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userRow) {
            // User with the provided email doesn't exist
            echo "Incorrect email";
            return false;
        }

        // Verify the password using password_verify
        if (password_verify($password, $userRow['password'])) {
            // Password matches, user exists
            echo "Correct";
            return $userRow['id'];
        } else {
            // Password doesn't match
            echo "Incorrect password";
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    /* Usage example:
    $email = "user@example.com"; // Replace with the email to check
    $password = "user_password"; // Replace with the password to check

    $userId = checkUser($conexion, $email, $password);

    if ($userId) {
        echo "User with ID $userId exists and provided password is correct.";
    } else {
        echo "User does not exist or provided password is incorrect.";
    }
     */
}

function doesUserExist($conexion, $username, $email) {
    try {
        $result = array('username' => false, 'email' => false);

        // Query to check if the username or email already exists in the database
        $sql = "SELECT username, email FROM dlf_users WHERE username = :username OR email = :email";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userRow) {
            if ($userRow['username'] == $username) {
                // Username is already taken
                $result['username'] = true;
            }
            if ($userRow['email'] == $email) {
                // Email is already in use
                $result['email'] = true;
            }

            // Echo messages specifying which one exists
            if ($result['username']) {
                echo "Username is already taken.";
            }
            if ($result['email']) {
                echo "Email is already in use.";
            }

            // Return true because at least one of them exists
            return true;
        } else {
            // Both are available
            echo "Username and email are available.";
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    /* Example of how to use the doesUserExist function
    $username = "existing_username";
    $email = "existing_email@example.com";

    if (doesUserExist($conexion, $username, $email)) {
        // User with either username or email already exists
        // Appropriate message is echoed in the function
    } else {
        // Both username and email are available
    }
     */
}







// Function to revoke admin privileges (set isAdmin to false) for a user by ID
function RevokeAdmin($conexion, $userId) {
    try {
        // Update the isAdmin value to false
        $sql = "UPDATE dlf_users SET isAdmin = 0 WHERE id = :userId";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        echo "Admin privileges revoked for user with ID $userId.<br>";

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    /* Usage examples:
    $userIdToRevoke = 1; // Replace with the user's ID to revoke admin privileges
    $userIdToMakeAdmin = 2; // Replace with the user's ID to grant admin privileges
    RevokeAdmin($conexion, $userIdToRevoke);
     */
}

// Function to grant admin privileges (set isAdmin to true) for a user by ID
function MakeAdmin($conexion, $userId) {
    try {
        // Update the isAdmin value to true
        $sql = "UPDATE dlf_users SET isAdmin = 1 WHERE id = :userId";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        echo "Admin privileges granted for user with ID $userId.<br>";

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}




function addComment($conexion, $user_id, $text, $city) {
    // Get the highest current ID value from the 'dlf_comments' table
    $sql = "SELECT MAX(id) FROM dlf_comments";
    $result = $conexion->query($sql);
    $row = $result->fetch();
    $next_id = $row[0] + 1;

    // Get the current date
    $current_date = date("Y-m-d");

    // Insert the new comment into the 'dlf_comments' table
    $sql = "INSERT INTO dlf_comments (id, user_id, date, text, city) 
            VALUES (:id, :user_id, :date, :text, :city)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $next_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':date', $current_date, PDO::PARAM_STR);
    $stmt->bindParam(':text', $text, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);

    if ($stmt->execute()) {
        // Comment added successfully
        return true;
    } else {
        // An error occurred
        return false;
    }

    /*  Usage example:
    $user_id = 1; // Replace with the actual user ID
    $text = "This is a sample comment.";
    $city = "New York"; // Replace with the actual city name

    if (addComment($conexion, $user_id, $text, $city)) {
        echo "Comment added successfully!";
    } else {
        echo "Failed to add the comment.";
    } */
}

function deleteComment($conexion, $commentId) {
    try {
        // Query to delete the comment based on its ID
        $sql = "DELETE FROM dlf_comments WHERE id = :commentId";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $stmt->execute();

        echo "Comment with ID $commentId has been deleted successfully.<br>";

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    /* Usage example:
    $commentIdToDelete = 1; // Replace with the comment's ID to delete
    deleteComment($conexion, $commentIdToDelete);
     */
}



function addCountry($conexion, $continent, $countryName) {
    try {
        // Check if the continent exists
        $checkContinentQuery = "SELECT continent_id FROM dlf_continents WHERE name = :continent";
        $stmt = $conexion->prepare($checkContinentQuery);
        $stmt->bindParam(':continent', $continent, PDO::PARAM_STR);
        $stmt->execute();

        $continentRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$continentRow) {
            // Continent does not exist
            echo "Continent '$continent' does not exist in the database.<br>";
            return false;
        }

        // Check if the country already exists in the continent
        $checkCountryQuery = "SELECT country_id FROM dlf_countries WHERE name = :countryName AND continent_id = :continent_id";
        $stmt = $conexion->prepare($checkCountryQuery);
        $stmt->bindParam(':countryName', $countryName, PDO::PARAM_STR);
        $stmt->bindParam(':continent_id', $continentRow['continent_id'], PDO::PARAM_INT);
        $stmt->execute();

        $countryRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($countryRow) {
            // Country already exists
            echo "Country '$countryName' already exists in continent '$continent'.<br>";
            return false;
        }

        // Insert the country into the dlf_countries table
        $insertCountryQuery = "INSERT INTO dlf_countries (continent_id, name) VALUES (:continent_id, :countryName)";
        $stmt = $conexion->prepare($insertCountryQuery);
        $stmt->bindParam(':continent_id', $continentRow['continent_id'], PDO::PARAM_INT);
        $stmt->bindParam(':countryName', $countryName, PDO::PARAM_STR);
        $stmt->execute();

        echo "Country '$countryName' added to continent '$continent'.<br>";

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    /* Usage example:
    $continent = 'Europe';
    $countryName = 'France';
    addCountry($conexion, $continent, $countryName);
     */
}

function getArticle($conexion, $cityId) {
    try {
        // Retrieve the HTMLtext for the city
        $getHTMLQuery = "SELECT HTMLtext FROM dlf_cities WHERE city_id = :cityId";
        $stmt = $conexion->prepare($getHTMLQuery);
        $stmt->bindParam(':cityId', $cityId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            // City does not exist or no HTMLtext available
            echo "City with ID '$cityId' not found or no HTMLtext available.<br>";
            return null;
        }

        // Return the HTMLtext for the city
        return $result['HTMLtext'];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}


function addCity($conexion, $country, $cityName, $HTMLtext) {
    try {
        // Check if the country exists
        $checkCountryQuery = "SELECT country_id FROM dlf_countries WHERE name = :country";
        $stmt = $conexion->prepare($checkCountryQuery);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->execute();

        $countryRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$countryRow) {
            // Country does not exist
            echo "Country '$country' does not exist in the database.<br>";
            return false;
        }

        // Check if the city already exists in the country
        $checkCityQuery = "SELECT city_id FROM dlf_cities WHERE name = :cityName AND country_id = :country_id";
        $stmt = $conexion->prepare($checkCityQuery);
        $stmt->bindParam(':cityName', $cityName, PDO::PARAM_STR);
        $stmt->bindParam(':country_id', $countryRow['country_id'], PDO::PARAM_INT);
        $stmt->execute();

        $cityRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cityRow) {
            // City already exists
            echo "City '$cityName' already exists in country '$country'.<br>";
            return false;
        }

        // Insert the city into the dlf_cities table with HTMLtext
        $insertCityQuery = "INSERT INTO dlf_cities (country_id, name, HTMLtext) VALUES (:country_id, :cityName, :HTMLtext)";
        $stmt = $conexion->prepare($insertCityQuery);
        $stmt->bindParam(':country_id', $countryRow['country_id'], PDO::PARAM_INT);
        $stmt->bindParam(':cityName', $cityName, PDO::PARAM_STR);
        $stmt->bindParam(':HTMLtext', $HTMLtext, PDO::PARAM_STR);
        $stmt->execute();

        echo "City '$cityName' added to country '$country' with HTMLtext.<br>";

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }


    /* Usage example:
    $country = 'France'; // Replace with the actual country name
    $cityName = 'Paris'; // Replace with the actual city name
    $HTMLtext = ;
    addCity($conexion, $country, $cityName $HTMLtext);
    */
}

function editCityHTML($conexion, $cityId, $newHTMLtext) {
    try {
        // Check if the city exists
        $checkCityQuery = "SELECT city_id FROM dlf_cities WHERE city_id = :cityId";
        $stmt = $conexion->prepare($checkCityQuery);
        $stmt->bindParam(':cityId', $cityId, PDO::PARAM_STR);
        $stmt->execute();

        $cityRow = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($cityRow);
        if (!$cityRow) {
            // City does not exist
            echo "City '$cityId' does not exist in the database.<br>";
            return false;
        }

        // Update the HTMLtext for the city
        $updateCityQuery = "UPDATE dlf_cities SET HTMLtext = :newHTMLtext WHERE city_id = :city_id";
        $stmt = $conexion->prepare($updateCityQuery);
        $stmt->bindParam(':newHTMLtext', $newHTMLtext, PDO::PARAM_STR);
        $stmt->bindParam(':city_id', $cityRow['city_id'], PDO::PARAM_INT);
        $stmt->execute();

        echo "HTMLtext for city '$cityId' updated successfully.<br>";

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    /* Usage example:
    $cityId = 'Paris'; // Replace with the actual city name
    $newHTMLtext = '<p>This is the updated HTML text for Paris.</p>'; // Replace with the actual HTML text

    editCityHTML($cityName, $newHTMLtext);
    */
}


function deleteCity($conexion, $country, $cityName) {
    try {
        // Check if the country exists
        $checkCountryQuery = "SELECT country_id FROM dlf_countries WHERE name = :country";
        $stmt = $conexion->prepare($checkCountryQuery);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->execute();

        $countryRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$countryRow) {
            // Country does not exist
            echo "Country '$country' does not exist in the database.<br>";
            return false;
        }

        // Delete the city based on country and city name
        $deleteCityQuery = "DELETE FROM dlf_cities WHERE country_id = :country_id AND name = :cityName";
        $stmt = $conexion->prepare($deleteCityQuery);
        $stmt->bindParam(':country_id', $countryRow['country_id'], PDO::PARAM_INT);
        $stmt->bindParam(':cityName', $cityName, PDO::PARAM_STR);
        $stmt->execute();

        echo "City '$cityName' in country '$country' has been deleted successfully.<br>";

        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    /* Usage example:
    $country = 'France'; // Replace with the actual country name
    $cityName = 'Paris'; // Replace with the actual city name
    deleteCity($conexion, $country, $cityName);
     */
}

function ShowColumns($conexion, $table, $columns) { // muestra los valores en las columnas escogidas
    $columnList = implode(', ', $columns);
    $sql = "SELECT $columnList FROM $table";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $row) {
        $rowData = [];
        foreach ($columns as $column) {
            $rowData[] = $row[$column];
        }
        echo implode(" | ", $rowData) . '<br>';
    }
    echo "- - - - - - - - - - - - - - - - - - - - - - - - - - - -<br>";
}

function ShowAllColumns($conexion, $table) {
    $sql = "SELECT * FROM $table";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $row) {
        $rowData = [];
        foreach ($row as $column => $value) {
            $rowData[] = "$column: $value";
        }
        echo implode(" | ", $rowData) . '<br>';
    }
    echo "- - - - - - - - - - - - - - - - - - - - - - - - - - - -<br>";
}

function ShowDatabase($conexion) { // muestra las tablas y sus columnas
    $sql = "SHOW TABLES";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        echo $table . "<br>";

        $sql = "DESCRIBE $table";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();

        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($columns as $column) {
            echo "- " . $column . "<br>";
        }
    }
}
?>