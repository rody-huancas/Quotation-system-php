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

    // Función para agregar un concepto a la cotización
    $('#add_to_quote').on('submit', add_to_quote);
    function add_to_quote(e) {
        e.preventDefault();

        let form = $('#add_to_quote'),
            action = 'add_to_quote',
            data = new FormData(form.get(0)),
            errors = 0;

        // Agregar la acción al objeto data
        data.append('action', action);

        // validar el concepto
        let concepto = $('#concepto').val(),
            precio = parseFloat($('#precio_unitario').val());

        if (concepto.length < 5) {
            notify('Ingresa un concepto válido por favor.', 'danger');
            errors++;
        }

        // validar el precio
        if (precio < 10) {
            notify('Ingresa un precio mayor a $10.', 'danger');
            errors++;
        }

        if (errors > 0) {
            notify('Completa el formulario', 'danger');
            return false;
        }

        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            data: data,
            beforeSend: () => {
                form.waitMe();
            }
        }).done(res => {
            if (res.status === 201) {
                notify(res.msg);
                form.trigger('reset');
                get_quote();
            } else {
                notify(res.msg, 'danger');
            }
        }).fail(err => {
            notify('Hubo un problema con la petición, intenta nuevamente');
            form.trigger('reset');
        }).always(() => {
            form.waitMe('hide');
        })
    }

    // Función para reiniciar la cotización
    $('.restart_quote').on('click', restart_quote);
    function restart_quote(e) {
        e.preventDefault();

        let button = $(this),
            action = 'restart_quote';

        if (!confirm('¿Estás seguro?')) return false;

        // Petición
        $.ajax({
            url: 'ajax.php',
            type: 'post',
            dataType: 'json',
            data: { action }
        }).done(res => {
            if (res.status === 200) {
                notify(res.msg);
                get_quote();
            } else {
                notify(res.msg, 'danger');
            }
        }).fail(err => {
            notify('Hubo in problema con la petición', 'danger');
        }).always(() => { });
    }

    // Función para borrar un concepto
    $('body').on('click', '.delete_concept', delete_concept);
    function delete_concept(e) {
        e.preventDefault();

        let button = $(this),
            id = button.data('id'),
            action = 'delete_concept';

        if (!confirm('¿Estás seguro?')) return false;

        // Petición
        $.ajax({
            url: 'ajax.php',
            type: 'post',
            dataType: 'json',
            data: { action, id },
            beforeSend: () => {
                $('body').waitMe();
            }
        }).done(res => {
            if (res.status === 200) {
                notify(res.msg);
                get_quote();
            } else {
                notify(res.msg, 'danger');
            }
        }).fail(err => {
            notify('Hubo un problema con la petición', 'danger');
        }).always(() => {
            $('body').waitMe('hide');
        })
    }
});