</div>

        <!-- Footer -->
        <div class="text-center mt-4 text-gray-500 text-sm">
            Habing<span class="text-orange-600">Ibaan</span> | 2025
        </div>
    </div>

    <script>
        // Add interactive functionality
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const deleteButtons = document.querySelectorAll('.fa-trash-alt');

            // Add click handlers for checkboxes
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const row = this.closest('div[class*="flex items-center justify-between p-4"]');
                    if (this.checked) {
                        row.classList.add('bg-blue-50');
                    } else {
                        row.classList.remove('bg-blue-50');
                    }
                });
            });

            // Add click handlers for delete buttons
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const row = this.closest('div[class*="flex items-center justify-between p-4"]');
                    if (confirm('Are you sure you want to delete this product?')) {
                        row.style.opacity = '0.5';
                        setTimeout(() => {
                            row.remove();
                        }, 300);
                    }
                });
            });

            // Add Product button functionality
            const addBtn = document.querySelector('button:contains("Add Product")');
            const addButton = document.querySelector('.bg-orange-700');
            if (addButton) {
                addButton.addEventListener('click', function() {
                    alert('Add Product functionality would be implemented here');
                });
            }

            // Logout functionality
            const logoutBtn = document.querySelector('.bg-red-600');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to logout?')) {
                        alert('Logout functionality would be implemented here');
                    }
                });
            }
        });
    </script>
</body>
</html>