<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Seller</title>
  <stye>

  </stye>
</head>

<body>
	<? 
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
				<select name="service">
					<option selected hidden value="">Please select your delivery service.</option>
					<?
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
		
			<?
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
			<?	}?>
    </table>
  </div>
  <div class="showHistory" id="saleHistory">
    <table id="history_table" style="width: 75vw;">
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
  <div class="footer">
    <h3>Total Sale <span></span></h3>
    <button onclick="showSaleHistory()"> Sale History </button>
  </div>
  <button onclick="resetStore()"> reset Store </button>

  <script type="text/javascript" src="dummy.js"></script>
  <script type="text/javascript" src="storeConfig.js"></script>
  <script>
    /*var id = 0
    const prod = JSON.parse(getAllProduct())
    prod.forEach(doc => {
      console.log(doc)
      addingStore(doc)
    })*/
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
    }

    function closeSaleHistory() {
      document.getElementById("saleHistory").style.display = "none"
      document.querySelector("body").style.backgroundColor = "#ffffff"
    }
/*
    function addingStore(doc) {
      const innerHEML = `
      <tr id = "prod${id++}">
        <td>${doc.name}</td>
        <td>${doc.stock}</td>
        <td>${doc.price}</td>
        <td>"none"</td>
        <td>"pic"</td>
        <td><button>remove</button></td>
      </tr>
      `
      const prev = document.getElementById("product_table").innerHTML + innerHEML
      document.getElementById("product_table").innerHTML = prev
    }

    function addingSaler(doc) {

    }
	
    function addClick() {
      const doc = {
        name: document.getElementById("add_name").value,
        stock: parseFloat(document.getElementById("add_stock").value),
        price: parseFloat(document.getElementById("add_price").value),
		picture: document.getElementById("add_picture").value
      }
      addProduct(doc)
      console.log(doc)
    }
*/
    function resetValue() {
      document.getElementById("add_name").value = ""
      document.getElementById("add_stock").value = 0
      document.getElementById("add_price").value = 0
    }
	  function resetStore(){
		  var check = confirm("Are you sure to reset your store?");
		  if(check == true){
			  alert("reset completed !");
		  }
		  if(check == false){
			  alert("Coward");
		  }
	  }

  </script>
</body>

</html>