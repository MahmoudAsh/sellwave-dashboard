import './bootstrap';

// Task management app functionality
document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation for tasks, products, and orders
    const deleteButtons = document.querySelectorAll('.delete-task, .delete-product, .delete-order');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const itemType = button.classList.contains('delete-task') ? 'task' : 
                           button.classList.contains('delete-product') ? 'product' : 'order';
            if (!confirm(`Are you sure you want to delete this ${itemType}? This action cannot be undone.`)) {
                e.preventDefault();
            }
        });
    });

    // Auto-hide success messages
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.opacity = '0';
            setTimeout(() => successMessage.remove(), 300);
        }, 3000);
    }
}); 