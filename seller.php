<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <title>Seller</title>
  <style>
    .background-sale-history {
      position: absolute;
      width: 100vw;
      height: 100vh;
      top: 0px;
      left: 0px;
      background-color: black;
      opacity: 0.5;
    }
  </style>
</head>

<body>
<<<<<<< HEAD
  <?php
  session_start();
  include("connection.php");
  $user = $_SESSION['username'];

  $strDelivery = "SELECT `service_name` FROM `delivery`";
  $objQuery1 = $connect->query($strDelivery);
  //$objResult1 = $objQuery1->fetch_array();
  ?>
  <div id="not-history">
    <h1 class="d-flex justify-content-center"> Seller </h1>
    <div style="margin:10px">
      <h4><?php echo $_SESSION['username']; ?><span id="usernameSeller"></span></h4>
      <button class="btn btn-success" onclick="showAddingForm()"> Add</button>
      <a class="btn btn-danger float-right" href="customer.php">Back</a>
    </div>
    <div id="addingForm" style="display: none; transition: 1s; margin:10px">
      <form id="formAdding" action="updatestock.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <div>
          <a>Name : </a><input type="text" id="add_name" name="name" required />
        </div>
        <div>
          <a>stock : </a><input type="number" id="add_stock" value="0" name="stock" required />
        </div>
        <div>
          <a>price : </a><input type="number" id="add_price" value="0" name="price" required />
        </div>
        <div>
          <a>picture : </a><input type="file" id="add_picture" name="picture" required />
        </div>
        <div class="dropdown">
          <div id="my_service" class="drop_service">
            <select name="service" required>
              <option selected hidden value="">Please select your delivery service.</option>
              <?php
              foreach ($objQuery1 as $row) {
                echo "<option name=" . $row['service_name'] . " value=" . $row['service_name'] . ">" . $row['service_name'] . "</option>";
                echo "\n";
              }
              ?>
            </select>
          </div>
        </div>
        <!--button onclick="addClick()" id="upload" name="add"> Add </button-->
        <input class="btn btn-success" type="submit" value="Add" onClick="addClick()" id="upload" name="add" />
        <button class="btn btn-danger" onclick="closeAddingForm()"> Cancle </button>
      </form>
    </div>
    <div>
      <table class="table" id="product_table" style="width: 100vw;">
        <tr>
          <th>Product Name</th>
          <th>stock</th>
          <th>price</th>
          <th>sold</th>
          <th>product picture</th>
          <th>remove</th>
        </tr>
        <?php
        $userID = $connect->query("SELECT userID FROM login WHERE username = '" . $user . "'")->fetch_array()['userID'];
        $strList = "SELECT * FROM `itemtosell` WHERE `userID` = '" . $userID . "'";
        $objQuery2 = $connect->query($strList);
        /*$objResult2 = $objQuery2->fetch_array();
			$name = $objQuery2['name'];*/

        foreach ($objQuery2 as $row) { ?>
          <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['stock']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['sold']; ?></td>
            <td><img src="upload/<?php echo $row['picture']; ?>" hight="60" width="60" /></td>
            <td>
              <form action="remove.php" method="post" id="remove"><button name="remove" type="submit" value="<?php echo $row['name'] ?>" form="remove">Remove</button></form>
            </td>
          </tr>
        <?php  } ?>
      </table>
    </div>
    <div class="footer">
      <h4 class="d-flex justify-content-center">Total Sale <span></span></h4>
      <button class="btn btn-primary" onclick="showSaleHistory()"> Sale History </button>
      <button class="btn btn-danger float-right" onclick="resetStore()"> Reset Store </button>
    </div>
=======
	<?php
	session_start();
	include("connection.php");
	$user = $_SESSION['username'];
	
	$strDelivery = "SELECT `service_name` FROM `delivery`";
	$objQuery1 = $connect->query($strDelivery);
	//$objResult1 = $objQuery1->fetch_array();
	?>
  <h1> Seller </h1>
  <div>
    <p><? echo $_SESSION['username'];?><span id="usernameSeller"></span></p>
    <button onclick="showAddingForm()"> Add</button>
    <a href="customer.php">Back</a>
  </div>
  <div id="addingForm" style="display: none; transition: 1s">
    <form id="formAdding" action="updatestock.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div>
		  <a>Name : </a><input type="text" id="add_name" name="name" required/>
      </div>
      <div>
        <a>stock : </a><input type="number" id="add_stock" value="0" name="stock" required/>
      </div>
      <div>
        <a>price : </a><input type="number" id="add_price" value="0" name="price" required/>
      </div>
		<div>
			<a>picture : </a><input type="file" id="add_picture" name="picture" required/>
		</div>
		<div class="dropdown">
			<div id="my_service" class="drop_service">
				<select name="service" required>
					<option selected hidden value="">Please select your delivery service.</option>
					<?php
					foreach($objQuery1 as $row){
						echo "<option name=".$row['service_name']." value=".$row['service_name'].">".$row['service_name']."</option>";
						echo "\n";
					}
					?>
				</select>
			</div>
		</div>
      <!--button onclick="addClick()" id="upload" name="add"> Add </button-->
		<input type="submit" value="Add" onClick="addClick()" id="upload" name="add"/>
	  </form>
      <button onclick="closeAddingForm()"> Cancle </button>
  </div>
  <div>
    <table id="product_table" style="width: 100vw;">
      <tr>
        <th>Product Name</th>
        <th>stock</th>
        <th>price</th>
        <th>sold</th>
        <th>product picture</th>
        <th>remove</th>
      </tr>
		
			<?php
			$userID = $connect->query("SELECT userID FROM login WHERE username = '".$user."'")->fetch_array()['userID'];
			$strList = "SELECT * FROM `itemtosell` WHERE `userID` = '".$userID."'";
			$objQuery2 = $connect->query($strList);
			/*$objResult2 = $objQuery2->fetch_array();
			$name = $objQuery2['name'];*/
			
			foreach($objQuery2 as $row){ ?>
			<tr>
				<td><? echo $row['name'];?></td>
				<td><? echo $row['stock'];?></td>
				<td><? echo $row['price'];?></td>
				<td><? echo $row['sold'];?></td>
				<td><img src="upload/<? echo $row['picture'];?>" hight="60" width="60"/></td>
				<td><form action="remove.php" method="post" id="remove"><button name="remove" type="submit" value="<? echo $row['name']?>" form="remove">Remove</button></form></td>
			</tr>
			<?php	}?>
    </table>
>>>>>>> d8115565de1ebd00953bfe2116c1d5461b427359
  </div>

  <div class="showHistory" id="saleHistory">
    <div>
      <p class="background-sale-history" style="height:100vh"> </p>
    </div>
    <table class="table" id="history_table" style="width: 75vw;">
      <tr>
        <th>Cutomer Id</th>
        <th>Product Name</th>
        <th>buy</th>
        <th>total price</th>
        <th>delivery</th>
      </tr>
    </table>
    <button onclick="closeSaleHistory()">close</button>
  </div>


  <script type="text/javascript" src="dummy.js"></script>
  <script type="text/javascript" src="storeConfig.js"></script>
  <script>
    function showAddingForm() {
      var form = document.getElementById("addingForm")
      form.style.display = "block"
    }

    function closeAddingForm() {
      var form = document.getElementById("addingForm")
      resetValue()
      form.style.display = "none"
    }

    function showSaleHistory() {
      document.getElementById("saleHistory").style.display = "block"
      document.querySelector("body").style.backgroundColor = "#aaaaaa"
      document.getElementById("not-history").style.filter = "blur(10px)"
    }

    function closeSaleHistory() {
      document.getElementById("saleHistory").style.display = "none"
      document.querySelector("body").style.backgroundColor = "#ffffff"
      document.getElementById("not-history").style.filter = "blur(0px)"
    }

    function resetValue() {
      document.getElementById("add_name").value = ""
      document.getElementById("add_stock").value = 0
      document.getElementById("add_price").value = 0
    }

    function resetStore() {
      var check = confirm("Are you sure to reset your store?");
      if (check == true) {
        alert("reset completed !");
      }
      if (check == false) {
        alert("Coward");
      }
    }
  </script>
</body>

</html>