@include('admin.includes.header')
@include('admin.includes.sidebar')

<!-- Scoped styles to remove arrows from the stock number input -->
<style>
    /* Hide spinners for the stock input only */
    #stockQty::-webkit-outer-spin-button,
    #stockQty::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    #stockQty { -moz-appearance: textfield; appearance: textfield; }
    /* Optional: ensure consistent width on small screens */
    @media (max-width: 640px) { #stockQty { width: 4.5rem; } }
    
</style>

<!-- Product Update/Add Card -->
<div class="flex flex-1 justify-center items-center min-h-full bg-gray-50">
    <div class="bg-white rounded-lg shadow p-8 w-full max-w-xl border border-gray-200">
        <h2 class="text-2xl font-bold text-center mb-2 tracking-wide">PRODUCT UPDATE</h2>
        <hr class="mb-6">
        <form class="flex flex-col items-center gap-6">
            <div class="flex gap-8 w-full justify-center">
                <!-- Image Upload -->
                <div class="flex flex-col items-center">
                    <label for="productImage" class="flex flex-col items-center justify-center h-32 w-32 border-2 border-gray-300 rounded cursor-pointer bg-gray-100 hover:bg-gray-200">
                        <span class="text-4xl text-gray-400"><i class="fas fa-plus"></i></span>
                        <input type="file" id="productImage" name="productImage" class="hidden" />
                    </label>
                    <span class="mt-2 text-sm text-gray-500">Upload Product Image</span>
                </div>
                <!-- Product Fields -->
                <div class="flex flex-col gap-3 flex-1">
                    <!-- Product Type -->
                    <select class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 text-gray-700">
                        <option value="" selected disabled>Select Product Type</option>
                        <option value="bag">Bag</option>
                        <option value="wallet">Wallet</option>
                        <option value="facemask">Facemask</option>
                        <option value="blanket">Blanket</option>
                        <option value="textiles">Textiles</option>
                        <option value="other">Other</option>
                    </select>
                    <input type="text" placeholder="Product Name" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400" />
                    <input type="text" placeholder="Product Description" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400" />
                    <input type="number" placeholder="Product Price" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400" />
                </div>
            </div>
            <!-- Stocks Update -->
            <div class="flex items-center gap-3 w-full justify-center">
                <input id="stockQty" type="number" value="1" min="0" step="1" inputmode="numeric" class="border border-gray-300 rounded px-3 py-2 w-16 text-center focus:outline-none focus:ring-2 focus:ring-orange-400" />
                <button id="btnPlus" type="button" class="bg-gray-200 text-gray-700 rounded-full p-2 hover:bg-gray-300" aria-label="Increase stock">
                    <i class="fas fa-plus"></i>
                </button>
                <button id="btnMinus" type="button" class="bg-gray-200 text-gray-700 rounded-full p-2 hover:bg-gray-300" aria-label="Decrease stock">
                    <i class="fas fa-minus"></i>
                </button>
                <span class="text-gray-600 text-sm">Update Stocks</span>
            </div>
            <!-- Add Product Button -->
            <button type="submit" class="bg-orange-700 text-white px-6 py-2 rounded text-lg font-medium hover:bg-orange-800 transition-colors mt-2">Add Product</button>
        </form>
    </div>
</div>

<!-- Lightweight script to wire up plus/minus buttons -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const qty = document.getElementById('stockQty');
        const btnPlus = document.getElementById('btnPlus');
        const btnMinus = document.getElementById('btnMinus');
        if (!qty || !btnPlus || !btnMinus) return;

        const getNum = (v) => {
            const n = parseInt(v, 10);
            return Number.isNaN(n) ? 0 : n;
        };

        const step = getNum(qty.getAttribute('step') || '1') || 1;
        const min = getNum(qty.getAttribute('min') || '0');

        btnPlus.addEventListener('click', function () {
            qty.value = String(getNum(qty.value) + step);
        });
        btnMinus.addEventListener('click', function () {
            const next = Math.max(min, getNum(qty.value) - step);
            qty.value = String(next);
        });
    });
</script>

@include('admin.includes.footer')