
    $(document).ready(function() {
        // Evento que se dispara cuando se colapsa o expande un elemento
        $('.collapse').on('show.bs.collapse', function() {
            // Cierra los elementos que no son el que se está abriendo
            $('.collapse').not(this).collapse('hide');
        });
    });

