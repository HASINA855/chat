<script>
    $.ajax({
        url: '{{ URL::to('searchDiscution') }}/{{ $data }}',
        type: 'get',
        dataType: 'json',
        success: (response) => {
            console.log(response)
            $('.listOf_discution').html('<div class="d-flex flex-column text-muted align-items-center justify-content-center" style="height: 40vh"><i class="fas fa-spinner fa-pulse fa-2x"></i>chargement.......</div>')
            var data = "";
            if (response.length == 0) {
                data += 'Acun resulat trouver'
            } else {
                for (let i = 0; i < response.length; i++) {

                    if (response[i].user.id == {{ Auth::user()->id }}) continue
                    data +=
                        ' <div class="d-flex align-item-center justify-content-between mb-2 " >'
                    data += '<div class="d-flex align-item-start justify-content-start" style="gap: 10px">'
                    data += '<img src="http://127.0.0.1:8000/profile_users/' + response[i].user.profile +
                        '" width="40" height="40" class="rounded-circle shadow p-1" alt="">'
                    data += '<div>'
                    data += '<b>' + response[i].user.nom + ' ' + response[i].user.prenom + '</b><br>'

                    if (response[i].discution.length != 0) {
                        data +=
                            '<span class="btn btn-sm  send__message" user_id="'+response[i].user.id+'" identifient="'+response[i].discution[0].id+'"><img src="{{asset('icones/messenger-svgrepo-com.svg')}}" width="20" alt=""> Envoyer un Message</span>'
                    } else {
                        data +=
                            '<span class="btn  border-0 shadow-none btn-sm add_to_discution" user_id="'+response[i].user.id+'" > <img src="{{asset('icones/add-plus-svgrepo-com.svg')}}" width="15" alt=""> Demarer un conversation</span>'
                    }

                    data += '</div>'
                    data += '</div>'
                    if (response[i].user.status != 0) {
                        data += '<div style="width: 8px;height: 8px;" class="bg-success rounded-circle">'
                        data += '</div>'
                    }else{
                        data += '<div style="width: 8px;height: 8px;" class="bg-secondary rounded-circle">'
                        data += '</div>'
                    }
                    data += '</div>'
                    data += '</div>'
                }
            }
            setTimeout(() => {
                    $('.listOf_discution').html(data)
                },
                1000);
        },
        error: (error) => {
            console.log(error)
        }
    })

    $(document).on('click', '.send__message', function() {
        var id_discutionWith = $(this).attr('identifient')
        var chatTo_id = $(this).attr('user_id')
        $.ajax({
            url: '{{ URL::to('updateStatusMessage') }}/' + id_discutionWith,
            type: 'get',
            success: () => {
                window.location.href = 'message/' + id_discutionWith + '/' + chatTo_id
            }
        })
    })

    $(document).on('click','.add_to_discution',function(){
        var chatTo_id = $(this).attr('user_id')
        $.ajax({
            url: '{{ URL::to('add_to_discution') }}/' + chatTo_id,
            type: 'get',
            success: (response) => {
                window.location.href = 'message/' + response[0].id + '/' + chatTo_id
                // console.log(response)
            }
        })
    })
</script>



