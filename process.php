<?php
session_start();
$conn = mysqli_connect("localhost","root","","items_option");

if(isset($_POST['submit']))
{
    // echo "test";
    // print_r( $_POST['productname']);
    // print_r( $_POST['quantity']);
    // print_r( $_POST['grams']);
    
    $name = $_POST['name'];
    $location = $_POST['location'];
    $date = date('Y-m-d', strtotime($_POST['date']));
    // $itemname = $_POST['item_name'];
    // $quantity = $_POST['quantity'];
    // $gram = $_POST['grams'];

    $sql = "INSERT INTO request_item (name, location, date) VALUES ('$name','$location','$date')";

    if($conn->query($sql) === TRUE)
    {
        $last_id = $conn->insert_id;
        echo $last_id;
        $quantityarr = $_POST['quantity'];
        $gramsarr = $_POST['grams'];
        $i = 0;
        $_SESSION['status'] = "Insert values Done";
        foreach($_POST['productname'] as $product){
            $sql = "INSERT INTO items (requestid, itemname, quantity, gram) VALUES ('$last_id','$product','$quantityarr[$i]', $gramsarr[$i])";
            if($conn->query($sql) === FALSE){
                $_SESSION['status'] = "Insert values Failed";
                echo "Failed Insert";
            }
            $i++;
        }
        echo $i;
        header("Location: index.php");
    }
    else
    {
        $_SESSION['status'] = "Insert values Failed";
        header("Location: index.php");
    }
}
?>