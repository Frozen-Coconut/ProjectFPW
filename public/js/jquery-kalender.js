$('document').ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    initialise()
});

const date = new Date();

function initialise() {
    $("#year-now").val(date.getFullYear());
    $("#month-now").val(date.getMonth());

    updateSemua();
}

function updateSemua() {
    setTulisan()
    loadKalender()
}

function kurang() {
    var bulanSekarang = parseInt($("#month-now").val())-1;
    var tahunSekarang = parseInt($("#year-now").val());

    if (bulanSekarang == -1) {
        bulanSekarang = 11;
        tahunSekarang = tahunSekarang-1;
    }

    $("#month-now").val(bulanSekarang);
    $("#year-now").val(tahunSekarang);

    updateSemua();
}

function tambah() {
    var bulanSekarang = parseInt($("#month-now").val())+1;
    var tahunSekarang = parseInt($("#year-now").val());

    if (bulanSekarang == 12) {
        bulanSekarang = 0;
        tahunSekarang = tahunSekarang+1;
    }

    $("#month-now").val(bulanSekarang);
    $("#year-now").val(tahunSekarang);

    updateSemua();
}

function setTulisan() {
    const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    var namaBulan = months[$("#month-now").val()];

    $("#label-sekarang").html(namaBulan+" - "+$("#year-now").val())
}

function loadKalender() {
    $.ajax({
        type:"get",
        url:"/user/ajax-kalender",
        data: {
            "month" : $("#month-now").val(),
            "year" : $("#year-now").val()
        }
    }).then(res => {
        $("#layout-kalender").html(res);
    })
}
