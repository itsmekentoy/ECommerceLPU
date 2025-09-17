<div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
        <h3>Shopping Cart</h3>
        <button class="close-cart" onclick="toggleCart()">&times;</button>
    </div>
    <div class="cart-content" id="cartContent">
        <p style="text-align: center; color: var(--muted-foreground); padding: 2rem;">Your cart is empty</p>
    </div>
    <div class="cart-total" id="cartTotal" style="display: none;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
            <span>Total:</span>
            <span id="totalAmount">₱0.00</span>
        </div>
        <button class="checkout-btn">Proceed to Checkout</button>
    </div>
</div>