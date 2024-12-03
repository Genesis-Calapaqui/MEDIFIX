<?php 
function siteTitle()
{	
	global $con;
	$array = $con->query("select * from site where id='1'");
	$row = $array->fetch_assoc();
	return $row['title'];
}
function siteName()
{	
	global $con;
	
	$array = $con->query("select * from site where id='1'");
	$row = $array->fetch_assoc();
	return $row['name'];
}
function adminName()
{
    global $con;

    if (isset($_SESSION['userId'])) {
        $array = $con->query("select * from users where id='$_SESSION[userId]'");
        $row = $array->fetch_assoc();
        return $row['name'];
    } else {
        return "Guest";
    }
}
function getAdminName($id)
{	
	global $con;
	
	$array=$con->query("select * from users where id='$id'");
	$row=$array->fetch_assoc();
	return $row['name'];
}
function getAllCat()
{	
	global $con;
	
	$array = $con->query("select * from categories");
	while($row = $array->fetch_assoc())
	{
		echo "<option value='$row[id]'>$row[name]</option>";
	}
	
}
function loginUser($email, $password, $mysqli)
{
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND password='$password'");

    if ($result->num_rows > 0) {
        session_start();
        $data = $result->fetch_assoc();
        $_SESSION['userId'] = $data['id'];
        $_SESSION['bill'] = array();
        header('location:index.php');
    } else {
        return "Login Error! Try again.";
    }
}
function addToBill($id, $con)
{
    $array = $con->query("select * from inventeries where id = '$id'");
    $row = $array->fetch_assoc();
    $name = $row['name'];
    $price = $row['price'];
    $qty = '1';
    $item = array(
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'qty' => $qty
    );

    array_push($_SESSION['bill'], $item);
}

function removeFromBill($id)
{
    foreach ($_SESSION['bill'] as $key => $value) {
        if ($_SESSION['bill'][$key]['id'] == $id) {
            unset($_SESSION['bill'][$key]);
            break;
        }
    }
}

function add($a, $b)
{
    return $a + $b;
}

 ?>