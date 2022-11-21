$('document').ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function snap_pay() {
    $.ajax({
        type:"get",
        url:"/project/ajax-snapToken",
        data:{

        }
    }).then(res=>{
        snap_now(res);
    })
}

function snap_now(transaction_token) {
    window.snap.pay(transaction_token, {
        onSuccess: function(result) {
            update_transaction(result["order_id"],result["payment_type"],2);
        },
        // onPending: function(result) {
        //     console.log(result)
        // },
        onError: function(result) {
            update_transaction(result["order_id"],result["payment_type"],3);
        }
    });
}

function update_transaction(order_id, payment_type, status_code) {
    $.ajax({
        type:"GET",
        url:"/project/ajax-update",
        data: {
            "order_id" : order_id,
            "payment_type" : payment_type,
            "status" : status_code
        }
    }).then(res => {
        if (status_code == 2) {
            alert('Berhasil')
        }
        else {
            alert("Gagal");
        }
    });
}
