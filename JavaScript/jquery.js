$(document).ready(function () {
    var max_fields = 10;
    var wrapper = $(".phonesNumber");
    var add_button = $(".addField");

    var x = wrapper.find('input[type=tel]').length;
    add_button.on("click", function (e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            wrapper.append('<div><input type="tel" name="phones[]"/><a href="#" class="remove_field">Удалить</a></div>');
        } else {
            alert('Максимум телефонов');
        }

        if (x < max_fields) add_button.show(); else add_button.hide();
    });

    wrapper.on("click", ".remove_field", function (e) {
        e.preventDefault();
        $(this).closest('div').remove();
        x--;

        if (x < max_fields) add_button.show(); else add_button.hide();
    });
});