<?php session_start(); ?>
<?php //$_SESSION['p_id']=$_GET['p_id']; ?>
<?php $p_id=$_SESSION['p_id']; ?>
<?php $userid=$_SESSION['userid']; ?>

<?php
$connection =  oci_connect($username = 'sritapa',
                         $password = 'Electromec123',
                         $connection_string = '//oracle.cise.ufl.edu/orcl');
						 

  
$query = "SELECT PRICE FROM STEP2SHOPIFY_PRODUCT where PRODUCTID =$p_id";
$result = oci_parse($connection, $query);
oci_execute($result);

//$c_id=$_POST['CATEGORYID'];

while($res = oci_fetch_array($result))
{
$price_id=$res[0];
}
echo $price_id;

//$userid = '3000167';
$qty = '1';

$query2 = "insert into STEP2SHOPIFY_CART(USERID,PRODUCTID,QUANTITY,PRICE) values(:userid,:prod_id,:qty,:price)";
$result2 = oci_parse($connection, $query2);

oci_bind_by_name($result2,':userid',$userid);
oci_bind_by_name($result2,':prod_id',$p_id);
oci_bind_by_name($result2,':qty',$qty);
oci_bind_by_name($result2,':price',$price_id);

$que2=oci_execute($result2);

if($que2){
$suc="Successfully Added to Cart!!";
}
else{
$suc="Not Allowed to add in cart";
} 
?>


<?php session_start(); ?>
<html>
<head>
<meta charset="utf-8"
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Step2Shopify</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<div id="container">
<div id="top_div">
<div class="heading">
<h1 align="LEFT"><img src="img/logo.jpg" width="187" height="50" alt="" class="img-thumbnail"/>   Step2Shopify</h1></div></div>

<div class="tool">
<div class="btn-toolbar" role="toolbar">
 		
<div class="btn-group">
   		<button type="button" class="btn btn-info" onclick="window.location.href='create1.php';">Home</button>
   		<button type="button" class="btn btn-info" onclick="window.location.href='My_Account.php';">My Account</button>
   		<button type="button" class="btn btn-info" onclick="window.location.href='.php';">My Cart</button>
		<button type="button" class="btn btn-success" onclick="window.location.href='create1.php';">LogOut</button>
  		</div>
		<div class="btn-group">
  <button type="button" class="btn btn-primary">Books</button>
  <button type="button" class="btn btn-primary">Clothing</button>
  <button type="button" class="btn btn-primary">Furniture</button>
  <button type="button" class="btn btn-primary">Electronics</button>
  <button type="button" class="btn btn-primary">OfficeSupplies</button>
	</div>
</div></div></div>
</div>    
</div>
</head>
<body background="img/background9.jpg">




<div id="bottom_div">
<?php $image_path="img/PRODUCTS/" ?>
<?php $image_extension=".jpg" ?>

<?php //$_SESSION['p_id']=$_GET['p_id']; ?>
<?php $p_id=$_SESSION['p_id']; ?>


<div id = 'Product-Specifications'
   style="
      top: 99;
      left: 200;
      position: absolute;
      z-index: 1;
      visibility: show;">
<img width="300" height="300" 
src= "<?php echo $image_path.$p_id.$image_extension?>" />
</div>

<div id = 'Product-Specifications'
   style="
      top: 200;
      left: 700;
      position: absolute;
      z-index: 1;
      visibility: show;">

<?php $connection = oci_connect($username = 'sritapa',
                          $password = 'Electromec123',
                          $connection_string = '//oracle.cise.ufl.edu/orcl');
?>
<table>
<col width="600"> 
<td>
<?php $query = "select * from step2shopify_product WHERE productid='".$p_id."'";	?>
<?php $result = oci_parse($connection, $query);
oci_execute($result);
while($row=oci_fetch_array($result,OCI_BOTH))
{ ?>

<?php
echo "<p>Product Details ID# &nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp"; 
echo $row[0];
echo "<div style ='font:30px Verdana,tahoma,sans-serif;color:#00000'> $row[1] </div>";
echo "<br/>";
echo "<div style ='font:25px Arial,tahoma,sans-serif;color:#00000'> $ $row[3] </div>";
echo "<br />\n";
echo "<br />\n";
echo "<div style ='font:20px Arial,tahoma,sans-serif;color:#00000'> Stock Left :- $row[4] </div>";
} 
?>
</td>
</table>
</div>


<div id = 'Product-Specifications'
   style="
      top: 450;
      left: 200;
      position: relative;
      z-index: 1;
      visibility: show;">



<table>
<tr>
<form action = "cart.php" method="get">
<button  type="submit" class="btn btn-primary">Add to Cart</button>
</form> 
<?php echo $suc ?>
</tr>
</table>
</div>
</body>
</html>


