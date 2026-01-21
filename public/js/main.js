// public/js/main.js

document.addEventListener('DOMContentLoaded', function() {
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Confirmation dialogs
    const deleteLinks = document.querySelectorAll('a[href*="/delete/"]');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    });

    // DataTable initialization (if you want to add later)
    if (typeof $.fn.dataTable !== 'undefined') {
        $('#employeeTable, #departmentTable, #positionTable, #salaryTable, #leaveTable').DataTable({
            "pageLength": 10,
            "ordering": true,
            "searching": true,
            "language": {
                "search": "Search:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries"
            }
        });
    }

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    // Number formatting for salary inputs
    const salaryInputs = document.querySelectorAll('input[name*="salary"], input[name*="allowance"], input[name*="deduction"]');
    salaryInputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value) {
                this.value = parseFloat(this.value).toFixed(2);
            }
        });
    });

    // Calculate net salary automatically
    const basicSalary = document.querySelector('input[name="basic_salary"]');
    const allowance = document.querySelector('input[name="allowance"]');
    const deduction = document.querySelector('input[name="deduction"]');
    const netSalary = document.querySelector('input[name="net_salary"]');

    if (basicSalary && allowance && deduction && netSalary) {
        [basicSalary, allowance, deduction].forEach(input => {
            input.addEventListener('input', calculateNetSalary);
        });

        function calculateNetSalary() {
            const basic = parseFloat(basicSalary.value) || 0;
            const allow = parseFloat(allowance.value) || 0;
            const deduc = parseFloat(deduction.value) || 0;
            netSalary.value = (basic + allow - deduc).toFixed(2);
        }
    }

    // Highlight current page in navbar
    const currentPage = window.location.pathname.split('/')[2] || 'dashboard';
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    navLinks.forEach(link => {
        if (link.getAttribute('href').includes(currentPage)) {
            link.classList.add('active');
        }
    });
});

// Utility function to format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(amount);
}

// Print function
function printPage() {
    window.print();
}