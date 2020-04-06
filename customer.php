<!DOCTYPE html>
<html lang="en">
<? include('connection.php');
	session_start();?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Customer</title>
</head>

<body>
	<?
	$strDelivery = "SELECT `service_name` FROM `delivery`";
	$objQuery = $connect->query($strDelivery);
	$objResult = $objQuery->fetch_array();
	?>
  <h1> Product List </h1>
  <div>
    <p><? echo $_SESSION['username'];?><span id="userNameProduct"></span></p>
    <a href="seller.php">Want to sell</a>
  </div>
  <div>
    <table id="product_table" style="width: 100vw;">
      <tr>
        <th> Name</th>
        <th> Stock</th>
        <th> Buy</th>
        <th> Price</th>
        <th> Product Pic</th>
        <th> Delivery</th>
      </tr>
		<?
		$getItem = $connect->query("SELECT * FROM itemtosell");
		foreach($getItem as $row){ ?>
		<tr>
			<td><? echo $row['name'];?></td>
			<td><? echo $row['stock'];?></td>
			<td><? echo $row['sold'];?></td>
			<td><? echo $row['price'];?></td>
			<td><img src="upload/<? echo $row['picture'];?>" height="60" width="60"/></td>
			<td><? echo $row['delivery'];?></td>
		</tr>
		<? }?>
    </table>
  </div>
  <div name="footer">
    <h3>Totle <span id="totalValue">0</span></h3>
    <button onclick="buy()">BUY</button>
  </div>
  <script type="text/javascript" src="dummy.js"></script>
  <script type="text/javascript" src="storeConfig.js"></script>
  <script>
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
	  if(totalValue == 0){
		  alert("Your cart is empty.")
	  }
		else{
		  alert("buy success")
		}
    }
  </script>
</body>

</html>