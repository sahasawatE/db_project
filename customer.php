<!DOCTYPE html>
<html lang="en">
<?php include('connection.php');
	session_start();
	?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Customer</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
	<style>
		.showPopUp{
			position: relative;
			display: inline-block;
			cursor: pointer;
		}
		.showPopUp .showMoreOption{
			visibility: hidden;
			text-align: center;
			border-radius: 6px;
			position: absolute;
			
		}
		.showPopUp .showMoreOption::after{
			content: "";
			position: absolute;
			top: 100%;
			left: 50%;
			margin-left: -5px;
			
		}
		.showPopUp .show{
			visibility: visible;
			
		}
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
	<?php
	$strDelivery = "SELECT `service_name` FROM `delivery`";
	$objQuery = $connect->query($strDelivery);
	$objResult = $objQuery->fetch_array();
	?>
<div id="not-history">	
  <h1 class="text-center"> Product List </h1>
	
  <div onClick="showInfo()" class="showPopUp">
		<p class="btn btn-danger font-weight-bold	" style="margin: 5px" id="sessionName"><?php echo $_SESSION['username'];?></p>
	</div>
	<button class="btn btn-primary" onclick="showSaleHistory()">Buy History </button>

	<a class="btn btn-light" href="logout.php">logout</a>
	<a class="float-right btn bg-dark" style="margin: 10px; text-decoration: underline; color:lightgray;" href="seller.php">Want to sell</a>
  <div>
	<form action="buy.php" method="post">
    <table class="table" id="product_table" style="width: 100vw;">
      <tr>
        <th> Name</th>
        <th> Stock</th>
        <th> Buy</th>
        <th> Price</th>
        <th> Product Pic</th>
        <th> Delivery</th>
		  	<th> Seller</th>
		  	<th> Select</th>
      </tr>
		<?php
		$getItem = $connect->query("SELECT * FROM itemtosell");
		foreach($getItem as $row){ 
		$sellerID = $row['userID'];
		$getSellerName = $connect->query("SELECT * FROM login WHERE userID = '".$sellerID."'")->fetch_array();
		$sellerName = $getSellerName['username'];
		?>
		<tr>
			<td><?php echo $row['name'];?></td>
			<td><?php echo $row['stock'];?></td>
			<td><?php echo $row['sold'];?></td>
			<td><?php echo $row['price'];?></td>
			<td><img src="upload/<?php echo $row['picture'];?>" height="60" width="60"/></td>
			<td><?php echo $row['delivery'];?></td>
			<td><?php echo $sellerName?></td>
			<td style="border: none"><button class="btn btn-primary" id="buy" value="<?php echo $row['productID']?>" type="submit" name="buy[]">Add to cart</button></td>
		</tr>
		<?php } //create array to push data to buy.php for chhecking stock and update?>
    </table>
		<input type="hidden" name="ispostback" value="true"/>
	  </form>
  </div>
  <div name="footer">
    <h3 class="d-flex justify-content-center">Total <span id="totalValue" class="totalValue">
		<? $inCart = $connect->query("SELECT * FROM cart WHERE username = '".$_SESSION['username']."'");
		$total_amount = 0;
		foreach($inCart as $row){
			$total_amount = $total_amount+$row['amount'];
		}
		echo '&nbsp;'.": ".$total_amount;
		?>
		</span></h3>
    <div align="center"><a href="cart.php"><button style="margin:10px" class="btn btn-success" onClick="">VIEW CART</button></a></div>
  </div>
</div>
	
  <div class="showHistory" id="saleHistory">
    <div>
      <p class="background-sale-history" style="height:100vh"> </p>
    </div>
    <table class="table" id="history_table" style="width: 75vw;">
      <tr>
        <th>Seller Id</th>
		<th>Seller name</th>
        <th>Product Id</th>
        <th>Product name</th>
        <th>total price</th>
      </tr>
		  <?
		$userID = $connect->query("SELECT * FROM login WHERE username = '" . $_SESSION['username'] . "'")->fetch_array()['userID'];
		  $getActivity = $connect->query("SELECT * FROM activitylog WHERE userID = '".$userID."' AND username = '".$_SESSION['username']."'");
		$total_price = 0;
		  foreach($getActivity as $row){ 
			$total_price = $total_price+$row['total_price'];
			?>
			  <tr>
		 		  <td><? echo $row['sellerID']?></td>
				  <td><? echo $row['sellerName']?></td>
				  <td><? echo $row['productID']?></td>
				  <td><? echo $row['product_name']?></td>
				  <td><? echo $row['total_price']?></td>
		      </tr>
		<?  }
		  ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>Total</td>
			<td><? echo $total_price?></td>
		</tr>
    </table>
    <button onclick="closeSaleHistory()">close</button>
  </div>
  <script type="text/javascript" src="dummy.js"></script>
  <script type="text/javascript" src="storeConfig.js"></script>
  <script>
	  var totalBuy = 0;
	  var cart = 0; //cart = 0 mean empty || cart = 1 mean not empty
    var id = 0;
    var totalValue = 0;
    var dummy_store = JSON.parse(getAllProduct())
    dummy_store.forEach(doc => {
      addTesting(doc, id)
      id++
    })
    function addTesting(doc, id) {
      var node = document.createElement("tr")
      node.setAttribute("id", `prod${id}`)

      var name = document.createElement("td")
      var stock = document.createElement("td")
      var buy = document.createElement("td")
      var price = document.createElement("td")
      price.setAttribute("class", "price")
      var productPic = document.createElement("td")
      var delivery = document.createElement("td")

      name.innerHTML = doc.name
      stock.innerHTML = doc.stock
      buy.innerHTML = `<input type="number" class="buy" value="0" onchange="changeBuy(${id})">`
      price.innerHTML = doc.price
      productPic.innerHTML = `pic`
      delivery.innerHTML = `<select id="select_delivery">
            <option value="Shopee">Shopee</option>
            <option value="Lazada">Lazada</option>
            <option value="Thaipost">Thaipos</option>
            <option value="Laramove">Laramove</option>
          </select>`

      node.appendChild(name)
      node.appendChild(stock)
      node.appendChild(buy)
      node.appendChild(price)
      node.appendChild(productPic)
      node.appendChild(delivery)

      document.getElementById("product_table").appendChild(node)
      id++
    }

   function changeBuy(id) {
      var buy = document.getElementById(`prod${id}`).querySelector(`.buy`).value
      const store = dummy_store[id]
      const value = store.price * (buy - store.buy)
      store.buy = parseInt(buy)
      totalValue += value
      console.log(dummy_store[id])
      document.getElementById(`totalValue`).innerHTML = totalValue
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
/*
   function buy() {
	  if(totalBuy == 0){
		  alert("Your cart is empty.")
	  }
		else{
		  alert("buying success")
			totalBuy = 0;
			cart = 0;
			document.getElementById("totalValue").innerHTML = totalBuy;
		}
    }*/
	function showInfo(){
		 var popup = document.getElementById("popup");
		 popup.classList.toggle("show");
	}
  </script>
</body>

</html>