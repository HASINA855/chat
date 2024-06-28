<script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
<script>
    get_discution()

    function get_discution() {
        $.ajax({
            url: '{{ URL::to('getMydiscution') }}',
            type: 'get',
            dataType: 'json',
            success: (response) => {
                var data = "";
                for (let i = 0; i < response.length; i++) {
                    data += ' <div identifient="' + response[i].id_discution + '" user_id="' + response[i]
                        .user
                        .id + '" user_to="' + response[i].user.email +
                        '" profile="' + response[i].user.profile +
                        '"  class="d-flex align-item-center justify-content-between mb-2 chatWith" style="cursor:pointer">'
                    data += '<div class="d-flex align-item-start justify-content-start" style="gap: 10px">'
                    data += '<div style="position: relative" >'
                    data += '<img src="http://127.0.0.1:8000/profile_users/' + response[i].user.profile +
                        '" width="40" height="40" class="rounded-circle shadow p-1" alt="">'
                    if (response[i].count_message != 0) {
                        data +=
                            '<span class="rounded-circle bg-danger text-light d-flex align-items-center justify-content-center" style="width: 15px;height: 15px;position:absolute;top:0;font-size:10px" >' +
                            response[i].count_message + '</span>'
                    }

                    data += '</div><div>'
                    data += '<b>' + response[i].user.nom + ' ' + response[i].user.prenom + '</b><br>'

                    if (response[i].last_message.length == 0) {
                        var last__message = "Demarer votre discution"
                        var date = ""
                    } else {
                        if (response[i].last_message[0].from == {{ Auth::user()->id }}) {

                            if (response[i].last_message[0].voice_message || response[i].last_message[0]
                                .images && !response[i].last_message[0].message) {
                                var last__message = 'vous: Vous avez envoyer un fichier'
                            } else {
                                var last__message = 'vous: ' + response[i].last_message[0].message
                            }

                            var newdate = new Date(response[i].last_message[0].created_at);
                            var d = newdate.toString().split(" ")
                            var date = d[0] + ' ' + d[1] + ' ' + d[3] + ' ' + d[4]
                        } else {

                            if (response[i].last_message[0].voice_message || response[i].last_message[0]
                                .images && !response[i].last_message[0].message) {
                                var last__message = 'Vous a avez envoyer un fichier'
                            } else {
                                var last__message = response[i].last_message[0].message
                            }

                            var newdate = new Date(response[i].last_message[0].created_at);
                            var d = newdate.toString().split(" ")
                            var date = d[0] + ' ' + d[1] + ' ' + d[3] + ' ' + d[4]
                        }
                    }

                    function fn(text, count) {
                        return text.slice(0, count) + (text.length > count ? "..." : "");
                    }
                    //  const d = new Date(response[i].last_message[0].created_at);
                    data +=
                        '<span>' + fn(last__message, 20) +
                        '<span class="text-muted" style="font-size: 10px">  ' + date + ' </span></span>'
                    data += '</div>'
                    data += '</div>'
                    data += '<div style="width: 8px;height: 8px;" class="bg-success rounded-circle">'
                    data += '</div>'
                    data += '</div>'
                }
                $('.listOf_discution').html(data)
            },
            error: (error) => {
                console.log(error)
            },
        })
    }
</script>
