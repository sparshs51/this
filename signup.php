<?php include("./inc/header.inc.php"); 

if (!isset($_SESSION["user_login"])) {
    echo "";
}
else
{
    echo "<meta http-equiv=\"refresh\" content=\"0; url=home.php\">";   
}

?>

<?php
$reg = @$_POST["reg"];
//declaring variables to prevent errors
$fn = ""; //First Name
$ln = ""; //Last Name
$un = ""; //Username
$em = ""; //Email
$em2 = ""; //Email 2
$pswd = ""; //Password
$pswd2 = ""; // Password 2
$d = ""; // Sign up Date
$u_check = ""; // Check if username exists
//registration form
$fn = strip_tags(@$_POST["fname"]);
$ln = strip_tags(@$_POST["lname"]);
$un = strip_tags(@$_POST["username"]);
$em = strip_tags(@$_POST["email"]);
$em2 = strip_tags(@$_POST["email2"]);
$pswd = strip_tags(@$_POST["password"]);
$pswd2 = strip_tags(@$_POST["password2"]);
$d = date("D-m-y"); // Year - Month - Day

if ($reg) 
{
if ($em==$em2) {
// Check if user already exists
$u_check = mysqli_query($conn,"SELECT username FROM users WHERE username='$un'");
// Count the amount of rows where username = $un
$check = mysqli_num_rows($u_check);
//Check whether Email already exists in the database
$e_check = mysqli_query($conn,"SELECT email FROM users WHERE email='$em'");
//Count the number of rows returned
$email_check = mysqli_num_rows($e_check);
if ($check == 0) {
  if ($email_check == 0) {
//check all of the fields have been filed in
if ($fn&&$ln&&$un&&$em&&$em2&&$pswd&&$pswd2) {
// check that passwords match
if ($pswd==$pswd2) {
// check the maximum length of username/first name/last name does not exceed 25 characters
if (strlen($un)>25||strlen($fn)>25||strlen($ln)>25) {
echo "The maximum limit for username/first name/last name is 25 characters!";
}
else
{
// check the maximum length of password does not exceed 25 characters and is not less than 5 characters
if (strlen($pswd)>30||strlen($pswd)<5) {
echo "Your password must be between 5 and 30 characters long!";
}
else
{
//encrypt password and password 2 using md5 before sending to database
$pswd = md5($pswd);
$result= mysqli_query($conn,"INSERT INTO 'users' (id,username,first_name,last_name,email,password,sign_up_date,activated,bio,profile_pic,friend_array) VALUES('6','$un','$fn','$ln','$em','$pswd','$d','0','Write something about yourself.','asd','no')");
if(!$result){
    die("OOps query failed");
}
die("<h2>Welcome to findFriends</h2>Login to your account to get started ... <a href = '/index.php'>here</a>" );
}
}
}
else {
echo "Your passwords don't match!";
}
}
else
{
echo "Please fill in all of the fields";
}
}
else
{
 echo "Sorry, but it looks like someone has already used that email!";
}
}
else
{
echo "Username already taken ...";
}
}
else {
echo "Your E-mails don't match!";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HomePage</title>  
    <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/signupstyles.css" />
    <link href="https://fonts.googleapis.com/css?family=Hi+Melody" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
</head>
<body>


        <div id="main">
            
            <h1>Sign up, it's FREE!</h1>
            <form action="#" class="formtext" method="post"  >
                    <input type="text" id="email" name="fname" placeholder="First Name" /><br>
                    <input type="text" id="email" name="lname" placeholder="Last Name" /><br>
                    <input type="text" id="email" name="email" placeholder="Email" /><br>
                    <input type="text" id="email" name="email2" placeholder="Email" /><br>
                    <input type="text" id="email" name="username" placeholder="Username" /><br>
                    <input type="password" id="password1" name="password" placeholder="Password" /><br>
                    <input type="password" id="password2" name="password2" placeholder="Password (repeat)" enabled="true" ><br> 
                    <input type="submit" name="reg">

            </form>
        </div>
        
        <footer>
            &copy Sparsh Singh
        </footer>
        <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <script src="js/jquery.complexify.js"></script>

</body></html>