<?php

//include 'conn.php';

session_start();
if(isset($_GET['remove'])){

$id=$_GET['remove'];
unset($_SESSION['my'][$id]);
header("location:cartt.php");

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
<br>
<br>
<h1 class="bg bg-dark text-white text-center">Cart page </h1>
               <p class="text-right"><span><?php
              //$_SESSION[$name]='mycart';
               if(isset($_SESSION['my'])){
               echo "<a href='index.php' >".count((array) $_SESSION['my'])."  <b><-</b></a>";
                   }
               else {
             echo 0;
                }
                ?></span> <b class="bg-light text-dark">Items in cart</b></p>
                <b></b>
              <div class="col-lg- m-auto">
              <?php
              
              if(!isset($_SESSION['my']) || count( (array) $_SESSION['my'])==0){

                echo "<h1> Cart is Empty</h1>";
                echo"<br>";
                echo"<a href='index.php'> Click here to : <b>Continue Shopping </b></a>";
              }

              else{


              
              ?>
               


                            <table class="table table-dark table-striped">
                         <thead>
                        <tr>
                        <br>
                          <th>Name</th>
                          <th>Price</th>
                         <th>Quantity</th>
                         <th>Amount</th>
                         <th>Action</th>
                
                
                          </tr>
                
                
                          </thead>
                          <tbody>
                         
                          <?php
                           $total=0;
                          include 'conn.php';
                          foreach($_SESSION['my'] as $Key => $value){
                              $q=mysqli_query($conn,"SELECT * FROM tblproduct WHERE pid=$Key");


                              foreach($q as $a ){
                                  echo "<tr?>
                                  <td>".$a['pname']."</td>
                                  <td>".$a['pprice']."</td>
                                  <td>".$value ['qty']."</td>
                                  <td>".$value ['qty'] *$a['pprice']."</td>
                                  <td><a class='btn btn-danger btn-sm' href='?remove=".$Key."'> Delete</a></td>
                                  
                                  </tr>
                                  ";
                                  $total +=$value ['qty'] *$a['pprice'];



                              }



                          }
                          
                          
                          ?>
                          
                          
                          </tbody>
                
                
                
                     </table>













                            

            </div>
        </div>

        <div class="row">
        <div class="col-lg-6"></div>
        <div class="col-lg-6">
        
        <h1 class="bg-dark text-white">Total Amount : <br><?php echo "RS. ".$total."/=";   ?> </h1>
        </div>
        </div>

        <?php

        }
        ?>
    </div>
</body>

</html>