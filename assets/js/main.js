$("document").ready(() => {

    // función para generar una notificación
    function notify(content, type = 'success') {
        let wrapper = $('.wrapper_notifications'),
            id = Math.floor((Math.random() * 500) + 1),
            notification = '<div class="alert alert-' + type + '" id="noty_' + id + '">' + content + '</div>',
            time = 5000;

        // insertar en el contenedor la notificación
        wrapper.append(notification);

        // ocultar la notificación
        setTimeout(() => {
            $('#noty_' + id).remove();
        }, time);

        return true;
    }


    notify("hola");
    // cargar el contenido de la cotización
    function get_quote() {
        let wrapper = $('.wrapper_quote');
        let action = 'get_quote_res';
        let name = $('#nombre');
        let company = $('#empresa');
        let email = $('#email');

        $.ajax({
            url: 'ajax.php',
            type: 'get',
            cache: false,
            dataType: 'json',
            data: { action },
            beforeSend: function () {
                wrapper.waitMe();
            }
        }).done(res => {
            if (res.status === 200) {
                name.val(res.data.quote.name);
                company.val(res.data.quote.company);
                email.val(res.data.quote.email);
                wrapper.html(res.data.html);
            } else {
                name.val('');
                company.val('');
                email.val('');
                wrapper.html(res.msg);
            }
        }).fail(err => {
            wrapper.html("Error");
        }).always(() => {
            wrapper.waitMe("hide");
        });
    }

    get_quote();
});