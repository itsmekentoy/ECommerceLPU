<script>
const cartItems = []
let cartCount = 0

function toggleCart() {
  document.getElementById("cartSidebar").classList.toggle("open")
  document.getElementById("overlay").classList.toggle("active")
}

function updateCartBadge() {
  const badge = document.getElementById("cartBadge")
  badge.textContent = cartCount
}

function renderCartItems() {
  const cartContent = document.getElementById("cartContent")
  const cartTotal = document.getElementById("cartTotal")

  if (!cartContent || !cartTotal) return

  if (cartItems.length === 0) {
    cartContent.innerHTML =
      '<p style="text-align: center; color: gray; padding: 2rem;">Your cart is empty</p>'
    cartTotal.style.display = "none"
    return
  }

  let total = 0
  cartContent.innerHTML = cartItems
    .map((item) => {
      const itemTotal = item.price * item.quantity
      total += itemTotal
      return `
  <div class="cart-item" 
       style="display: flex; align-items: center; margin-bottom: 15px; 
              padding: 10px; border-bottom: 1px solid #eee;">
      
    <img src="${item.image}" alt="${item.name}" 
         style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; margin-right: 12px;">
    
    <div class="cart-item-info" style="flex: 1;">
      <h4 style="margin: 0; font-size: 15px; color: #333;">${item.name}</h4>
      <div class="cart-item-price" 
           style="font-size: 14px; color: #666; margin: 5px 0;">
           ₱${item.price.toFixed(2)}
      </div>
      
      <div class="cart-item-quantity" 
           style="display: flex; align-items: center; gap: 5px;">
        
        <button onclick="updateQuantity(${item.id}, ${item.quantity - 1})" 
                style="width: 28px; height: 28px; background: #f0f0f0; border: 1px solid #ccc; 
                       border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;">
          -
        </button>
        
        <span style="min-width: 24px; text-align: center; font-size: 14px; color: #333;">
          ${item.quantity}
        </span>
        
        <button onclick="updateQuantity(${item.id}, ${item.quantity + 1})" 
                style="width: 28px; height: 28px; background: #f0f0f0; border: 1px solid #ccc; 
                       border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;">
          +
        </button>
        
        <button onclick="removeFromCart(${item.id})" 
                style="margin-left:auto; background:none; border:none; color:red; 
                       font-size: 13px; cursor:pointer;">
          Remove
        </button>
      </div>
    </div>
  </div>
`

    })
    .join("")

  document.getElementById("totalAmount").textContent = `₱${total.toFixed(2)}`
  cartTotal.style.display = "block"
}

function loadCart() {
  fetch("{{ route('cart.items') }}")
    .then((res) => res.json())
    .then((data) => {
      cartItems.length = 0
      cartCount = 0
      data.items.forEach((cartItem) => {
    if (cartItem.item) {
        cartItems.push({
        id: cartItem.item.id,
        name: cartItem.item.item_name,  // ✅ use item not items
        price: parseFloat(cartItem.item.price),
        image: "/storage/products/" + cartItem.item.file_path,
        quantity: cartItem.quantity,
        })
        cartCount += cartItem.quantity
    }
    })

      updateCartBadge()
      renderCartItems()
    })
}

function addToCart(productId) {
  fetch("{{ route('add.to.cart') }}", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": "{{ csrf_token() }}",
    },
    body: JSON.stringify({ item_id: productId, quantity: 1 }),
  })
    .then((res) => res.json())
    .then(() => loadCart())
}

function updateQuantity(productId, newQty) {
  if (newQty <= 0) return removeFromCart(productId)

  fetch("{{ route('update.cart.item') }}", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": "{{ csrf_token() }}",
    },
    body: JSON.stringify({ item_id: productId, quantity: newQty }),
  })
    .then((res) => res.json())
    .then(() => loadCart())
}

function removeFromCart(productId) {
  fetch("{{ route('remove.cart.item') }}", {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": "{{ csrf_token() }}",
    },
    body: JSON.stringify({ item_id: productId }),
  })
    .then((res) => res.json())
    .then(() => loadCart())
}

document.addEventListener("DOMContentLoaded", loadCart)
</script>