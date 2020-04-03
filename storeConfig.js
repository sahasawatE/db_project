function getAllProduct() {
  const store = localStorage.getItem('store')
  var s = ""
  for (const i in store) {
    s += store[i]
  }
  return store
}

const addProduct = (doc) => {
  const data = {
    name: doc.name ? doc.name : "Ubanana",
    stock: doc.stock ? doc.stock : 0,
    price: doc.price ? doc.price : 0,
    buy: 0,
    delivery: "",
    product_pic: "pic",
    sold: false
  }
  console.log(localStorage.store)

  const store = JSON.parse(localStorage.store || "[]")
  console.log(store)
  store.push(data)
  localStorage.setItem('store', JSON.stringify(store))
  alert("success")
}

function resetStore() {
  localStorage.setItem('store', [])
}