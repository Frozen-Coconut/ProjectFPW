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

var sort = -1;

function sortUbah() {
    sort = $("#sort option:selected").val();

    search();
}

function search() {
    $.ajax({
        type:"GET",
        url:"/project/ajax-daftar-tugas",
        data:{
            'search': $("#search-tag").val(),
            'sort' : sort
        }
    }).then(res => {
        $("#layout-daftar-tugas").html(res);
    });
}
