<?php
date_default_timezone_set('Asia/Dhaka');

// 1. Database Connection
$db = mysqli_connect("localhost", "root", "", "soham");

// Check connection and stop if it failed
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the user input from the POST request
$user_message = isset($_POST['txt']) ? trim($_POST['txt']) : '';

// Define the default response
$chatbot_reply = "I'm sorry, I don't have an answer for that yet.";

// --- 2. SELECT Query using Prepared Statements (Secure Lookup) ---

if (!empty($user_message)) {
    // Prepare the SELECT statement to find a reply
    $select_stmt = $db->prepare("SELECT reply FROM chatbot_hints WHERE question = ?");

    // Bind the user input parameter ('s' for string)
    $select_stmt->bind_param("s", $user_message);

    // Execute the statement
    $select_stmt->execute();

    // Get the result object
    $result = $select_stmt->get_result(); 

    // Check if a row was returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $chatbot_reply = $row['reply'];
    } 

    // Close the SELECT statement
    $select_stmt->close();
}


// --- 3. Insert User Message (Secure Logging) ---

// Only insert the user message if it's not empty
if (!empty($user_message)) {
    $added_on = date('Y-m-d H:i:s'); // Y-m-d H:i:s is a good, standard MySQL datetime format

    // Prepare the INSERT statement
    // Note: The 'user' type is hardcoded as it's a fixed value, not user input
    $insert_stmt = $db->prepare("INSERT INTO message (message, added_on, type) VALUES (?, ?, 'user')");

    // Bind parameters: 's' for message, 's' for added_on
    $insert_stmt->bind_param("ss", $user_message, $added_on);

    // Execute the statement
    $insert_stmt->execute();

    // Close the INSERT statement
    $insert_stmt->close();
}


// --- 4. Output the Chatbot's Reply ---
echo $chatbot_reply;
echo " "; // Print a space after the reply for separation
?>


<!--
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style>

	<link href="style.css" rel="stylesheet">
</style>
<a href="#"><small><input name="invalid"  type="button" id="admin_btn" value="Invalid?"></small></a>

<body>

</body>
</html>-->
