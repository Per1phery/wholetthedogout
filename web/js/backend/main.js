$( document ).ready(function() {
    $('.switch').bootstrapSwitch({onText: 'вкл', offText: 'выкл'}).on('switchChange.bootstrapSwitch', function () {
        var checkbox = $(this);
        checkbox.bootstrapSwitch('disabled', true);

        $.getJSON(checkbox.data('link') + '?' + 'status=' + (checkbox.is(':checked') ? 1 : 0) + '&id=' + checkbox.data('id'), function (response) {
            if (response.result === 'error') {
                alert(response.error);
            } else {
                checkbox.bootstrapSwitch('disabled', false);
            }
        });
    });
});