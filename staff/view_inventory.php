<!--
view_inventory.php
Purpose:
    Allows staff/managers to view inventory.
-->
<!DOCTYPE HTML>

<head>
<title>View Inventory</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../css/slider.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js/move-top.js"></script>
<script type="text/javascript" src="../js/easing.js"></script> 
<script type="text/javascript" src="../js/nav.js"></script>
<script type="text/javascript" src="../js/nav-hover.js"></script>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
    
    <?php
        session_start();
        require "../sql/serverinfo.php";
        if($_SESSION["manager"] == 1){
            //if employee is a manager
            include "../components/managerHeader_menu.html";
        }
        else{
            //else if normal employee
            include "../components/staffHeader_menu.html"; 
        }
    ?>
</head>
<body>
    <?php
        
        $link = mysqli_connect($host, $login, $password, $dbname);
        $query_string = "SELECT * FROM Products";
        $response = mysqli_query($link, $query_string);
        $num_rows = mysqli_num_rows($response);
        if ($num_rows == 0){
            echo "<h3>Inventory currently empty.</h3>";
            exit(0);
        }

        echo "<h3>Inventory</h3>";

        //Table header
        echo '
            <div class="orderlines">
            <table class="bordered">
            <tr>
                <th align="left">PRODUCT ID</td>
                <th align="left">NAME</td>
                <th align="left">PRICE</td>
                <th align="left">QTY</td>
            </tr>';
        while($row = mysqli_fetch_array($response)){
            echo '
                <tr>
                    <td>'.$row['prod_id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['price'].'</td>
                    <td>'.$row['qty'].'</td>
                </tr>
            ';
        }
        echo '</table><br/></div>';
            

    ?>
</body>