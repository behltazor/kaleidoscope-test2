$(document).ready(function () {
    $('.circle-loader').toggleClass('load-complete');
    $('.checkmark').toggle();

    $('.task-edit').click(function () {
        $.ajax({
            type: 'get',
            url: $(this).data('url')
        }).done(function (res) {
            $('#edit-modal .modal-body').html(res);
            $('#edit-modal').modal('show');
        });
    });

    $('#edit-modal .btn-primary').click(function () {
        $('#edit-modal form').submit();
    });
});