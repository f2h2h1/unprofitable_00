    "use strict"
    $(function () {
        $('.has-child').on('click', function () {
            if ($(this).hasClass('nav-show')) {
                $(this).removeClass('nav-show');
            } else {
                $(this).addClass('nav-show');
            }
        });

        $('.sidebar-switch').on('click', function () {
            if ($('.sidebar').hasClass('sidebar-show')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
        $('.content').on('click', function () {
            if ($('.sidebar').hasClass('sidebar-show')) {
                closeSidebar();
            }
        });
        function openSidebar() {
            $('.sidebar').addClass('sidebar-show');
        }
        function closeSidebar() {
            $('.sidebar').removeClass('sidebar-show');
        }
    });

    $("[data-confirm]").on("click", function() {
        console.log(1);
        let message = $(this).data('confirm');
        if (message === undefined) {
            return true;
        }
        if (!confirm(message)) {
            return false;
        }
    });