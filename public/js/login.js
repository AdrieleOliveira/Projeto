$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

$('#register').click(function (){


    $('#modalRegister').modal('show');
});
