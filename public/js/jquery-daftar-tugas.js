$('document').ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    loadDaftarTugas();
});

function loadDaftarTugas() {
    $.ajax({
        type:"GET",
        url:"/project/ajax-daftar-tugas",
        data:{

        }
    }).then(res => {
        $("#layout-daftar-tugas").html(res);
    });
}
