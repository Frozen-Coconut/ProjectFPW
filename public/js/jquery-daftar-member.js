$('document').ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const inputContainerNode = document.querySelector('#search');
    const emailsInput = EmailsInput(inputContainerNode);

    $('#search-result').delegate('div[name="add"]', 'click', addMember);

    function addMember() {
        const email = $(this).attr('id').split('-')[1];
        const options = {};
        const emailsContainer = document.getElementById('emails-con');
        addEmailToList(emailsContainer, email, options);
    }

    function createTag(email){
        return `<div class='tag'>
                <span>
                    ${email}
                </span>
                <i class="close-btn fa-solid fa-xmark" data-item='${email}'>
                    x
                </i>

            </div>`
    }

    $('#btnAdd').click(function(){
        // console.log(getEmailsList());
        $.ajax({
            url: '/project/member',
            type: 'POST',
            data: {
                'member': getEmailsList()
            },
            headers: {
                Accept: "application/json",
            },
        }).then( data => {
            if(alert(data.message)){}
            else window.location.reload();
        });
    });

    $('#search').delegate('input[type="email"]', 'keyup', function() {
        var query = $(this).val();

        $.ajax({
            url: '/project/search-member',
            type: 'GET',
            data: {
                'search': query
            },
        }).then( data => {
            if(data){
                $('#search-result').css('visibility','visible');
            }else{
                $('#search-result').css('visibility','hidden');
            }
            var html = '';
            for (var i = 0; i < data.length; i+= 1) {
                html += `<div id='member-${data[i]['email']}' name='add' class='flex flex-col p-2 cursor-pointer'>
                    <span>
                        ${data[i]['name']}
                    </span>
                    <span>
                        ${data[i]['email']}
                    </span>

                </div>`;
            }
            $('#search-result').html(html);
        })
    });


    $('#search-result').css('visibility','hidden');
});
