<script>
    $.ajax({
        url: '{{ URL::to('searchDiscution') }}/{{ $data }}',
        type: 'get',
        dataType: 'json',
        success: (response) => {
            console.log(response)
            $('.listOf_discution').html('chargement.......')
            var data = "";
            if (response.length == 0) {
                data += 'Acun resulat trouver'
            }else{
               for (let i = 0; i < response.length; i++) {

                if (response[i].id == {{ Auth::user()->id }}) continue
                data +=
                    ' <div class="d-flex align-item-center justify-content-between mb-2 chatWith" style="cursor:pointer">'
                data += '<div class="d-flex align-item-start justify-content-start" style="gap: 10px">'
                data += '<img src="http://127.0.0.1:8000/profile_users/' + response[i].profile +
                    '" width="40" height="40" class="rounded-circle shadow p-1" alt="">'
                data += '<div>'
                data += '<b>' + response[i].nom + ' ' + response[i].prenom + '</b><br>'
                data +=
                    '<span class="btn">Ajouter </span><span class="btn">Message</span>'
                data += '</div>'
                data += '</div>'
                data += '<div style="width: 8px;height: 8px;" class="bg-success rounded-circle">'
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
</script>
