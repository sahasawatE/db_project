<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD
<?php include('connection.php');
=======
<?php 
	include('connection.php');
>>>>>>> d8115565de1ebd00953bfe2116c1d5461b427359
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
	</style>
</head>

<body>
	<?php
	$strDelivery = "SELECT `service_name` FROM `delivery`";
	$objQuery = $connect->query($strDelivery);
	$objResult = $objQuery->fetch_array();
	?>
<<<<<<< HEAD
  <h1 class="text-center"> Product List </h1>
	
  <div onClick="showInfo()" class="showPopUp">
		<p class="btn btn-danger font-weight-bold	" style="margin: 5px" id="sessionName"><?php echo $_SESSION['username'];?></p>
		<a class="btn btn-light" href="profile.php">profile</a>
		<a class="btn btn-light" href="logout.php">logout</a>
	</div>
	<a class="float-right btn bg-dark" style="margin: 10px; text-decoration: underline; color:lightgray;" href="seller.php">Want to sell</a>
=======
  <h1> Product List  HAHA</h1>
	
  <div onClick="showInfo()" class="showPopUp">
    <p id="sessionName"><? echo $_SESSION['username'];?></p><span id="popup" class="showMoreOption">
	  	<table border="0" bgcolor="#ccffff">
			<tr><td><a href="profile.php">profile</a></td></tr>
			<tr><td><a href="logout.php">logout</a></td></tr>
		</table></span>
  </div>
	<a href="seller.php">Want to sell</a>
>>>>>>> d8115565de1ebd00953bfe2116c1d5461b427359
  <div>
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
		$getSellerName = $connect->query("SELECT * FROM login WHERE userID = '".$sellerID."'")->fetch_array()['username'];
		?>
		<tr>
			<td><?php echo $row['name'];?></td>
			<td><?php echo $row['stock'];?></td>
			<td><?php echo $row['sold'];?></td>
			<td><?php echo $row['price'];?></td>
			<td><img src="upload/<?php echo $row['picture'];?>" height="60" width="60"/></td>
			<td><?php echo $row['delivery'];?></td>
			<td><?php echo $getSellerName?></td>
			<td style="border: none"><button class="btn btn-primary" onClick="addToCart()" id="buy" value="<?php echo $row['name']?>">Add to cart</button></td>
		</tr>
		<?php }?>
    </table>
  </div>
  <div name="footer">
    <h3 class="d-flex justify-content-center">Totel <span id="totalValue" class="totalValue">0</span></h3>
    <button style="margin:10px" class="btn btn-success" onclick="buy()">BUY</button>
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
    }
	function showInfo(){
		 var popup = document.getElementById("popup");
		 popup.classList.toggle("show");
	}
	function addToCart(id){
		  var adding = confirm("Add to your cart ?");
		if(adding == 1){
			totalBuy++;
			document.getElementById("totalValue").innerHTML = totalBuy;
			cart = 1;
			var itemName = $('#buy').val();
			alert("added !!");
		}
		else{
			alert("fuck off!! you poor fuck!");
		}
	}
  </script>
</body>

</html>