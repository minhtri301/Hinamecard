(function ($) {
    // xử lý trang login
    $(document).ready(function () {
        var modal = $(".modals");
        var btn = $(".login.btn");
        var span = $(".close");

        btn.click(function () {
            modal.show();
        });

        span.click(function () {
            $('#login-code-input').val(null);
            modal.hide();
        });

        $(window).on("click", function (e) {
            if ($(e.target).is(".modals")) {
                $('#login-code-input').val(null);
                modal.hide();
            }
        });

        $(window).on("click", function (e) {
            if ($(e.target).is(".modal-form")) {
                $(".modal-form").hide();
            }
        });

        // Xử lý sau khi tắt modal
        $(document).on('hidden.bs.modal','.modal', function () {
            $('.errorSelect').hide();
            $('.errorInput').hide();
            // phone
            $('#inputPhone').val(null);
            // bank
            $('#inputBank').val(null);
            // links
            $('#inputLink').val(null);

            $('#id-phone').val('').trigger('change');
            $('#id-bank').val('').trigger('change');
            $('#id-link').val('').trigger('change');
        });

    });
})(jQuery);
