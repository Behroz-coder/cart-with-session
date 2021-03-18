<?php

//include 'conn.php';

session_start();
//session_name('mycart');//session name changed
//$_SESSION['my']=22;
// session_destroy();

if(isset($_GET['action'])=="add"){   
    $id=$_GET['id'];
    if(isset($_SESSION['my'][$id])){
     $pre=$_SESSION['my'][$id]['qty'];
     $_SESSION['my'][$id]=array("pid"=>$id,"qty"=>$pre+$_POST['quantity']);
    }else{
        $_SESSION['my'][]=array("pid"=>$id,"qty"=>$_POST['quantity']);
    }
    header( "location:cartt.php");   
}
// if(isset($_POST['submit'])){
//     $id=$_GET['id'];
//     $_SESSION['my'][]=array("pid"=>$id,"qty"=>$_POST['quantity']);
// }

// print_r($_SESSION['my']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">

            <p class="text-right"><span><?php
        //$_SESSION[$name]='mycart';
        if(isset($_SESSION['my'])){
            echo "<a href='cartt.php' >".count((array) $_SESSION['my'])."  <b>-></b></a>";
        }
        else {
            echo 0;
        }
        
        ?></span>Items in cart</p>
        <br>
          <h1 class="bg bg-dark text-white text-center">Shopping page </h1>
        
            <?php

include 'conn.php';

$query= "SELECT * FROM tblproduct";

$res=mysqli_query($conn,$query);

while($row=mysqli_fetch_array($res))

{
?>

            <div class="col-lg-4 m-auto">
          

                <form action="index.php?action=add&id=<?php echo $row['pid']?>" method="post" enctype= multipart/form-data>




                    <div class="card">

                        <img src="<?php echo $row['pimg'] ?>" height='100' width='100'>
                        <h4>Name: <?php echo $row['pname'] ?></h4>
                        <h4> Price:<?php echo $row['pprice'] ?></h4>
                        <input type="number" value="1" name="quantity" placeholder="Quantity" min="0">
                        <input type="submit" value="Add to Cart" name="btncart" class="btn btn-success">
                        <input type="hidden" name="hname" value="<?php echo $row['pname'] ?>">
                        <input type="hidden" name="hprice" value="<?php echo $row['pprice'] ?>">
                    </div>




                </form>



            </div>








            <?php

}
?>

        </div>
    </div>
</body>

</html>