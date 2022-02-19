<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<?php
session_start();
include('condb.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้านี้

$query = "SELECT * FROM items_option_1 ORDER BY id asc" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);

$queryadd = "SELECT * FROM address_option ORDER BY id asc" or die("Error:" . mysqli_error());
$resultadd = mysqli_query($con, $queryadd);

?>
<html>

<head>
     <title>Order Items Input</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
     <div class="container">
          <br />
          <br />
          <h2 align="center">Order</h2>
          <div class="form-group">
               <form name="add_name" id="add_name" action="process.php" method="POST">
                    <div>
                         <table class="table table-bordered" id="dynamic_field">
                              <tr>
                                   <p>Name
                                        <select name="name" class="form-control name_list" required>
                                             <option value="">-- Choose --</option>
                                             <?php foreach ($result as $row) { ?>
                                                  <option value="<?php echo $row["name"]; ?>">
                                                       <?php echo $row["name"]; ?>
                                                  </option>
                                             <?php } ?>
                                        </select>
                                   </p>
                                   <p>Location
                                        <select name="location" class="form-control name_list" required>
                                             <option value="">-- Choose --</option>
                                             <?php foreach ($resultadd as $row) { ?>
                                                  <option value="<?php echo $row["name"]; ?>">
                                                       <?php echo $row["name"]; ?>
                                                  </option>
                                             <?php } ?>
                                        </select>
                                   </p>
                                   <p>Date to be delivered
                                        <input type="date" name="date" placeholder="Product Name" class="form-control name_list" />
                                   </p>
                              </tr>

                              <h2 align="center">Items</h2>
                              <tr>
                                   <td>
                                        <input type="text" name="productname[]" placeholder="Product Name" class="form-control name_list" />
                                   </td>

                                   <td>
                                        <select name="quantity[]" class="form-control name_list">
                                             <option value="1">1</option>
                                             <option value="2">2</option>
                                             <option value="3">3</option>
                                             <option value="4">4</option>
                                        </select>
                                   </td>

                                   <td>
                                        <select name="grams[]" class="form-control name_list">
                                             <option value="1">1</option>
                                             <option value="2">2</option>
                                             <option value="3">3</option>
                                             <option value="4">4</option>
                                        </select>
                                   </td>
                                   <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                              </tr>
                         </table>
                         <?php
                         echo $_SESSION['status'];
                         $_SESSION['status'] = "";
                         ?>
                         <br/>
                         <!-- <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />   -->
                         <button type="submit" name="submit" class="btn btn-info" value="Submit">Confirm</button>
                    </div>
               </form>
          </div>
     </div>
</body>

</html>
<script>
     $(document).ready(function() {
          var i = 1;
          $('#add').click(function() {
               i++; //product                                                                                                 //quantity                                                                                                                                                                                                                   //grams                                                 
               $('#dynamic_field').append('<tr id="row' + i + '"> <td><input type="text" name="productname[]" placeholder="Product Name" class="form-control name_list" /></td> <td><select name="quantity[]" class="form-control name_list" <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option></select></td> <td><select name="grams[]" class="form-control name_list" <option value="0">0</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option></select></td>  <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
          });
          $(document).on('click', '.btn_remove', function() {
               var button_id = $(this).attr("id");
               $('#row' + button_id + '').remove();
          });
     });
</script>