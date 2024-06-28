<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>discution</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap.min.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/emojionearea.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tiny-slider.css') }}">
</head>

<body style="height: 100vh;" class="d-flex align-items-center justify-content-center">
    @include('animate')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between" style="gap: 10px">
                <h5>Transfert</h5>
                <form id="form_search_to_share">
                    <div class="input-group rounded-pill">
                        <input type="search" id="search_user_toshare" class="form-control form-control-sm shadow-none"
                            placeholder="Recherche .......">
                        <button class="input-group-text" type="submit"><img
                                src="{{ asset('icones/search-left-1504-svgrepo-com.svg') }}" width="10"
                                alt=""></button>
                    </div>
                </form>
            </div>

        </div>
        <div class="card-body list_user_on_discution">
        </div>
        <div class="card-footer">
            <button class="envoyer_multiple_message shadow-none  btn btn-primary btn-sm">Envoyer</button>

            <a href="{{ URL::to('message') }}/{{ $id_discution }}/{{ $id_user }}" class="btn shadow-none btn-outline-dark border-0 btn-sm">Quiter</a>
        </div>
    </div>
    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/emojionearea.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/recorder.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('bootstrap.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $('#search_user_toshare').on('input', function() {
            var data = $(this).val()
            if (data) {
               $.ajax({
                url:'{{URL::to('search_user_to_share')}}/'+data,
                type:'get',
                dataType:'json',
                success:(response) =>{
                    // console.log(response)
                    var data = ""
                    if(response.length==0){
                        data+='Aucun resultat pour votre recherche'
                    }else{
                        for (var i = 0; i < response.length; i++) {
                            if (response[i].id_discution == {{ $id_discution }}) {
                            data+='Aucun resultat pour votre recherche'
                              continue  
                            }
                            data += '<div class="d-flex align-items-center justify-content-between mb-2">'
                            data +=
                                '<div class="d-flex align-items-center justify-content-start " style="gap: 10px">'
                            data += '<img src="{{ asset('profile_users') }}/' + response[i].user[0].profile +
                                '" style="width: 40px;height: 40px;" class="rounded-circle p-1 shadow" alt="">'
                            data += ' <b>' + response[i].user[0].nom + ' ' + response[i].user[0].prenom + '</b>'
                            data += '</div>'
                            data +=
                                '<input class="form-check-input" type="checkbox" id_discution="' + response[
                                    i].id_discution + '" identifient__user="' + response[i].user[0].id +
                                '"  id="check_to_send" name="option1" value="something">'
                            data += '</div>'
                        }
                    }
                    $('.list_user_on_discution').html(data)
                }
               })
            } else {
                get_all_user_to_share()
            }
        })
        get_all_user_to_share()
        function get_all_user_to_share() {
            $.ajax({
                url: '{{ URL::to('get_user_to_share') }}',
                type: 'get',
                dataType: 'json',
                success: (response) => {
                    var data = ""
                    for (var i = 0; i < response.length; i++) {
                        if (response[i].id_discution == {{ $id_discution }}) continue
                        data += '<div class="d-flex align-items-center justify-content-between mb-2">'
                        data +=
                            '<div class="d-flex align-items-center justify-content-start " style="gap: 10px">'
                        data += '<img src="{{ asset('profile_users') }}/' + response[i].user.profile +
                            '" style="width: 40px;height: 40px;" class="rounded-circle p-1 shadow" alt="">'
                        data += ' <b>' + response[i].user.nom + ' ' + response[i].user.prenom + '</b>'
                        data += '</div>'
                        data +=
                            '<input class="form-check-input" type="checkbox" id_discution="' + response[
                                i].id_discution + '" identifient__user="' + response[i].user.id +
                            '"  id="check_to_send" name="option1" value="something">'
                        data += '</div>'
                    }
                    $('.list_user_on_discution').html(data)
                }
            })
        }

        var id_user = []
        var multiple_id_discution = [];
        $(document).on('change', '#check_to_send', function(e) {
            if ($(this).is(":checked")) {
                id_user.push($(this).attr('identifient__user'))
                multiple_id_discution.push($(this).attr('id_discution'))
            } else {
                var remove_id_user = $(this).attr('identifient__user')
                id_user = id_user.filter(function(e) {
                    return e !== remove_id_user
                })
                var remove_id_discution = $(this).attr('id_discution')
                multiple_id_discution = multiple_id_discution.filter(function(e) {
                    return e !== remove_id_discution
                })
            }
        })
        $(document).on('click', '.envoyer_multiple_message', function() {
            if (id_user.length != 0) {
                for (var i = 0; i < id_user.length; i++) {
                    $.ajax({
                        url: '{{ URL::to('send_multiple_message') }}',
                        type: 'post',
                        data: {
                            id_users: id_user[i],
                            multiple_id_discution: multiple_id_discution[i],
                            message: "{{ $message->message }}",
                            image: "{{ $message->images }}",
                            voice: '{{ $message->voice_message }}'
                        },
                        success: (response) => {
                            alert(response.success)
                            window.location.href =
                                "{{ URL::to('message') }}/{{ $id_discution }}/{{ $id_user }}"
                        }
                    })
                }
            } else {
                console.log('not')
            }
        })
    </script>
</body>

</html>
