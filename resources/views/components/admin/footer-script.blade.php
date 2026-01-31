<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- ✅ DataTables Core -->
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.min.js"></script>

<!-- ✅ DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>




@stack('adminscripts')

<!-- Sidebar Toggle Script -->
<script>
    document.getElementById("menu-toggle").addEventListener("click", function() {
        const wrapper = document.getElementById("wrapper");
        const icon = document.getElementById("menu-icon");

        wrapper.classList.toggle("toggled");

        // Toggle icon
        if (icon.classList.contains("bi-list")) {
            icon.classList.remove("bi-list");
            icon.classList.add("bi-x");
        } else {
            icon.classList.remove("bi-x");
            icon.classList.add("bi-list");
        }
    });
</script>

<script>
    $(document).ready(function() {

        let currentUrl = window.location.href;

        $('.sidebar-menu a').each(function() {
            let linkUrl = this.href;

            // Exact match or sub-route match
            if (currentUrl === linkUrl || currentUrl.startsWith(linkUrl)) {
                $('.sidebar-menu a').removeClass('active');
                $(this).addClass('active');
            }
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        toastElList.map(function (toastEl) {
            var toast = new bootstrap.Toast(toastEl, { delay: 5000 }) // 5 seconds
            toast.show()
        })
    });
</script>

