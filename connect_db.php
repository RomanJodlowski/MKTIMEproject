<?php # CONNECT TO MySQL DATABASE. Please read comments.

# Connect  on 'localhost' 'change username' 'change password' 'change database name'.


$link = mysqli_connect('localhost', 'root', '', 'mktime');
if (!$link) {
	# Otherwise fail gracefully and explain the error. 
	die('Could not connect to MySQL: ' . mysqli_error());
}
//echo 'Connected to the database successfully!';

/*In this example, you need to replace "localhost," "your_username," "your_password," and "your_database" with your actual database server details. 
If the connection is successful, it will print "Connected successfully." 
If there is an error in connecting to the database, it will display an error message using mysqli_connect_error().*/

?>