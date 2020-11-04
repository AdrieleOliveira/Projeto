console.log('open');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

$(document).ready(function (){
    console.log('oi');

    $('#newProduct').click(function (){
        console.log("hello");
        $('#modalProduto').modal().find('.modal-title').text("Cadastro de Produto");
        $('#id').val('');
        $('#description').val('');
        $('#price').val('');
        $('#modalProduto').modal('show');
    });
})


