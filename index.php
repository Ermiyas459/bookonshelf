
<?php

session_start();

 if(isset($_GET['page']))
 {
     $page = $_GET['page'];
 } else {
     $page = 'home';
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BookOnShelf</title>
<!--    <link rel="stylesheet" type="text/css" href="css/styles.css">-->
<!--    <link rel="stylesheet" type="text/css" href="../css/styles.css">-->

</head>
<body class="home-page">


<?php

include 'include/'. $page . '.inc.php';

if(isset($_SESSION['role']))
{
    if($_SESSION['role'] == 'user'){
        include("include/navbaruser.inc.php");
    } elseif ($_SESSION['role'] == 'admin') {
        include("include/navbar-manager.inc.php");
    }

} else {
    include 'include/navbar.inc.php';
}


//include("../include/navbar.inc.php");


?>




</body>
</html>
