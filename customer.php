<!DOCTYPE html>
<html lang="en">
<? include('connection.php');
	session_start();
	?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Customer</title>
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
	<?
	$strDelivery = "SELECT `service_name` FROM `delivery`";
	$objQuery = $connect->query($strDelivery);
	$objResult = $objQuery->fetch_array();
	?>
  <h1> Product List </h1>
	
  <div onClick="showInfo()" class="showPopUp">
    <p id="sessionName"><? echo $_SESSION['username'];?></p><span id="popup" class="showMoreOption">
	  	<table border="0" bgcolor="#ccffff">
			<tr><td><a href="profile.php">profile</a></td></tr>
			<tr><td><a href="logout.php">logout</a></td></tr>
		</table></span>
    
  </div>
	<a href="seller.php">Want to sell</a>
  <div>
    <table id="product_table" style="width: 100vw;">
      <tr>
        <th> Name</th>
        <th> Stock</th>
        <th> Buy</th>
        <th> Price</th>
        <th> Product Pic</th>
        <th> Delivery</th>
		  <th>Seller</th>
		  <th hidden="1"></th>
      </tr>
		<?
		$getItem = $connect->query("SELECT * FROM itemtosell");
		foreach($getItem as $row){ 
		$sellerID = $row['userID'];
		$getSellerName = $connect->query("SELECT * FROM login WHERE userID = '".$sellerID."'")->fetch_array()['username'];
		?>
		<tr>
			<td><? echo $row['name'];?></td>
			<td><? echo $row['stock'];?></td>
			<td><? echo $row['sold'];?></td>
			<td><? echo $row['price'];?></td>
			<td><img src="upload/<? echo $row['picture'];?>" height="60" width="60"/></td>
			<td><? echo $row['delivery'];?></td>
			<td><? echo $getSellerName?></td>
			<td style="border: none"><button onClick="addToCart()" id="buy" value="<? echo $row['name']?>">Add to cart</button></td>
		</tr>
		<? }?>
    </table>
  </div>
  <div name="footer">
    <h3>Totle <span id="totalValue" class="totalValue">0</span></h3>
    <button onclick="buy()">BUY</button>
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