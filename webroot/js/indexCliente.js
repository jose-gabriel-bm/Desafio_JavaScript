    function openDropDown() {
        document.querySelectorAll('.dropdown-child')[0].classList.toggle('show-menu-dw');
    }

    function redirecionarNovoCliente() {
        location.href = "http://localhost:8765/clientes/adicionar"
    }

    function redirecionarTelaView(id){
        location.href = `http://localhost:8765/clientes/view/${id}`
    }

    function redirecionarTelaEdit(id){
        location.href = `http://localhost:8765/clientes/edit/${id}`
    }

    function mudancaStatus(id){

        $.ajax({
            type: 'POST',
            url: 'clientes/mudarStatus/'+ id,
            beforeSend: function () {
            },
            success: function (response) {
                document.location.reload(true);
            }
        });

    }