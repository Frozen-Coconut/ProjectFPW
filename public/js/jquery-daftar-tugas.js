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
            'pm' : $("#pm").val()
        }
    }).then(res => {
        $("#layout-daftar-tugas").html(res);
    });
}

var sort = -1;

var mode_sort = false;

var counter = 0;

var ids = [];
var values = [];

function ubahModeSort() {
    if(mode_sort) {
        $("#save_sort").html('Urutkan');
        updateCustomSort();
    }
    else {
        munculkan();
        $("#save_sort").html('Simpan');
        counter = 1;
    }
    mode_sort = !mode_sort;
}

function munculkan() {
    var buttons = $(".check-list-sort");
    for (var i = 0; i< buttons.length; i+= 1){
        buttons.html("");
        buttons.removeClass("hidden");
    }
}

function clear() {
    var buttons = $(".check-list-sort");
    for (var i = 0; i< buttons.length; i+= 1){
        buttons.html("");
        buttons.addClass("hidden");
    }

    ids = [];
    values = [];
}

function sortCustom(id) {
    if (mode_sort) {
        if ( $("#"+id).html() == "") {
            $("#"+id).html(counter);
            ids.push(id);
            values.push(counter);
            counter += 1;
        }
        else {
            hilangkanIsiArray(id);
        }
    }
}

function hilangkanIsiArray(id) {
    idsTemp = [];
    valuesTemp = [];
    index = -1;
    for (var i = 0; i< ids.length ; i+=1) {
        if (ids[i] != id) {
            idsTemp.push(ids[i]);
            valuesTemp.push(values[i]);
        }
        else index = i;
    }

    $("#"+id).html("");

    for (var i = index; i< idsTemp.length; i+= 1) {
        valuesTemp[i] =  parseInt(valuesTemp[i])-1;
        $("#"+idsTemp[i]).html(valuesTemp[i]);
    }

    counter = valuesTemp[idsTemp.length-1];

    ids = idsTemp;
    values = valuesTemp;
}

function updateCustomSort() {
    $.ajax({
        type:"GET",
        url:"/project/update-custom-sort",
        data: {
            "id":ids,
            "value":values
        }
    }).then(res => {
        clear();
    });
}

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
            'sort' : sort,
            'pm' : $("#pm").val()
        }
    }).then(res => {
        $("#layout-daftar-tugas").html(res);
    });
}

function notify(id) {
    $.ajax({
        type:"GET",
        url:"/project/notify",
        data:{
            "id" :id
        }
    }).then(res => {
        alert('User sudah di notify');
    });
}
