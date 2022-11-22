$('document').ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    loadNotifikasi();
});

function loadNotifikasi() {
    $.ajax({
        type:"GET",
        url:"/project/ajax-notification",
        data:{

        }
    }).then(res=>{
        $("#layout-notifikasi").html(res)
    })
}

function deleteNotifikasi(id) {
    $.ajax({
        type:"GET",
        url:"/project/delete-notification",
        data:{
            "id":id
        }
    }).then(res=>{
        loadNotifikasi();
    })
}
