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
    @vite('resources/js/message.js')
</head>
<style>
    
    .hide {
        display: none !important;
    }

    .btn_toogle_menu:hover .toggle_menu_messanger {
        display: block !important;
        z-index: 100;
    }

audio{
    width: 200px;
    border-radius: 30px!important;
}
.left__message{
    background-color: #3498dbc0;
    /* border: 1px solid rgba(128, 128, 128, 0.253) */
    /* box-shadow: 0px 0px 3px rgba(128, 128, 128, 0.911) inset; */
    border-radius: 30px!important;
    padding: 10px 20px!important;
    color: white!important
}
.right__message{
    background-color: #ecf0f1;
    border-radius: 30px!important;
    padding: 10px 20px!important;
}

    
</style>

<body style="height: 100vh;" class="d-flex align-items-center justify-content-center">
    @include('animate')
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content border-0" >

                <!-- Modal Header -->
                <div class="modal-header">

                    <button type="button" class="btn-close text-light" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="my-slider">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" >
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">

                <div class="d-flex align-item-center justify-content-start" style="gap: 10px">
                    <a href="{{ URL::to('/discution') }}"><img src="{{ asset('icones/back-square-svgrepo-com.svg') }}"
                            width="20" alt=""></a>
                    <img src="{{ asset('profile_users/' . Auth::user()->profile) }}" width="40"
                        class="rounded-circle p-1" alt="">
                    <img src="{{ asset('profile_users/' . $profile->profile) }}" width="40"
                        class="rounded-circle p-1" alt="">
                </div>
                <div class="d-flex align-items-center justify-content-end" style="gap: 10px">

                    <form id="form_search_message">
                        <div class="input-group rounded-pill">
                            <input type="search" id="search_message" class="form-control form-control-sm shadow-none"
                                placeholder="Recherche .......">
                            <button class="input-group-text" type="submit"><img
                                    src="{{ asset('icones/search-left-1504-svgrepo-com.svg') }}" width="10"
                                    alt=""></button>
                        </div>
                    </form>
                    <div style="position:relative" class="btn_toogle_menu">
                        <a href="javascript:void(0)" class="text-muted btn shadow-none"><i class="fa fa-ellipsis-h"></i></a>
                        <div class="list-group toggle_menu_messanger"
                            style="position: absolute ;right:0;display: none;min-width: 250px;">
                            <a href="#" class="list-group-item list-group-item-action"  data-bs-toggle="modal"
                                data-bs-target="#myModal">Fichiers images</a>
                            <a href="#" class="list-group-item list-group-item-action">Suprimer votre
                                discution</a>
                            <a href="#" class="list-group-item list-group-item-action">Acrchiver</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body contentMEssage mb-3" style="height: 50vh;overflow-y: auto">
        </div>
        <form enctype="multipart/form-data" hidden id="send_vocal_message">
            @csrf
            <input type="file" id="message_vocal" name="voice_message">
            <input name="id_user" value="{{ $user_id }}">
            <input name="id_discution" value="{{ $id_discution }}">
        </form>
        <div id="recorder_file" style="display: none">
            <span class="text-muted" style="font-size: 15px">Enregistrement......</span>
            <img src="{{ asset('icones/64a6b0e0740e455bda54f399_Waveform.gif') }}" width="400" height="50"
                alt="">
        </div>

        <div class="d-flex align-items-center justify-content-start mb-2 listes_images"
            style="gap: 10px;display: none!important">
        </div>
        <div class="card-footer" style="position: relative;">
            <div class=" processing" style="gap: 10px;display: none;position: absolute;top: -40px">
                <img src="{{ asset('icones/200.gif') }}" width="60" alt="">
                <span class="text-muted" style="font-size: 15px">Entrain d'ecrire ........</span>
            </div>

            <form class="d-flex align-item-start justify-content-center send_message" enctype="multipart/form-data"
                style="gap: 10px">
                @csrf
                <label for="img_message" style="cursor: pointer"><img
                        src="{{ asset('icones/photo-camera-svgrepo-com.svg') }}" width="20"
                        alt=""></label>
                <input type="file" name="img_message[]" id="img_message" multiple hidden
                    onchange="display_image(this)">
                <input type="hidden" name="id_user" id="id_chat" value="{{ $user_id }}">
                <input type="hidden" name="id_discution" id="id__discution" value="{{ $id_discution }}">
                <textarea type="text" class="form-control" id="text_message" name="message" placeholder="message"
                    cols="3" rows="3"></textarea>
                <div>
                    <a href="javascript:void(0)" class=" recorder_audio btn shadow-none p-0 rounded-0"> <img
                            src="{{ asset('icones/microphone-svgrepo-com-2.svg') }}" width="20" alt=""
                            class="start_record"></a>
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-secondary shadow-none border-0 p-1 "><img src="{{asset('icones/paper-plane-svgrepo-com-1.svg')}}" width="30" alt=""></button>
                </div>

            </form>
        </div>
    </div>

    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/emojionearea.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/recorder.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('bootstrap.min.js') }}"></script>
    <script>

        
            $.ajax({
            url: '{{ URL::to('get_images_messages') }}/{{ $id_discution }}',
            type: 'get',
            dataType: 'json',
            success: (response) => {
                var data = ''
                if (response.length == 0) {
                    data += 'Aucun images trouvés'
                } else {
                    for (let i = 0; i < response.length; i++) {
                        data += '<div>'
                        data += '<div class="slide">'
                        data += '<div class="slide-imag image-1">'
                        data +=
                            '  <a target="_blank" href="{{ asset('message_photo') }}/' + response[i] +
                            '"><img src="{{ asset('message_photo') }}/' + response[i] +
                            '" class="w-100  rounded"  alt=""></a>'
                        data += '</div>'
                        data += '</div>'
                        data += '</div>'
                    }
                }
                $('.my-slider').html(data)
                var slider = tns({
                    container: ".my-slider",
                    'slideBy': '1',
                    "speed": 400,
                    'nav': false,
                    autoplay: true,
                    controls: true,
                    autoplayButtonOutput: false,
                    responsive: {
                        1600: {
                            items: 5,
                            gutter: 20
                        },
                        1024: {
                            items: 4,
                            gutter: 20
                        },
                        768: {
                            items: 3,
                            gutter: 20
                        },
                        480: {
                            items: 3,
                            gutter: 20
                        },
                        350: {
                            items: 3,
                            gutter: 20
                        },
                    }

                })
                $('[data-controls="prev"]').html('<i class="fa fa-angle-left"></i>')
                $('[data-controls="next"]').html('<i class="fa fa-angle-right"></i>')
                $('[data-controls="prev"]').addClass('btn btn-light rounded-circle shadow m-1')
                $('[data-controls="next"]').addClass('btn btn-light rounded-circle shadow m-1')
            }
        })
        
        
        window.id_discution = {{ $id_discution }}

        function display_image(input) {

            for (let i = 0; i < input.files.length; i++) {
                if (input.files && input.files[i]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.listes_images').append('<img src="' + e.target.result +
                            '" alt="" style="width: 60px;height: 60px;">')
                    }
                }
                reader.readAsDataURL(input.files[i]);
            }
            $('.listes_images').html(
                '<button class="btn p-0 border-0 shadow-none annuler_image" style="font-size:30px">&times;</button> ')
            $('.listes_images').show()
        }
        $(document).on('click', '.annuler_image', function() {
            $('.listes_images').html('')
            $('.img_message').val('')
        })
        $('#text_message').emojioneArea({
            pickerPosition: 'top'
        })
        $(document).on('click', '.stop_record', function() {
            $('.recorder_audio').html(
                '<img src="{{ asset('icones/microphone-svgrepo-com-2.svg') }}"  width="20" alt="" class="start_record">'
            )
            $('#recorder_file').hide()
        })
        $('textarea').on('input',function(){
            $.ajax({
                url: '{{ URL::to('listen_processing_message') }}/{{ $id_discution }}',
                type: 'get',
            })
        })
        $(document).on('input', '.emojionearea-editor', function() {
            $.ajax({
                url: '{{ URL::to('listen_processing_message') }}/{{ $id_discution }}',
                type: 'get',
            })
        })
        $('.send_message').on('submit', function(e) {
            e.preventDefault()
            var data = $(this)[0]
            var formData = new FormData(data)
            $.ajax({
                url: '{{ URL::to('send__message') }}',
                type: 'post',
                contentType: false,
                processData: false,
                data: formData,
                success: (response) => {
                    data.reset()
                    show_message()
                    $('.listes_images').html('')
                    $('.emojionearea-editor').text('')
                    var scroll = $('.contentMEssage');
                    scroll.animate({
                        scrollTop: scroll.prop("scrollHeight")
                    });
                }
            })
        })
        show_message()

        function show_message() {
            $.ajax({
                url: '{{ URL::to('show__message') }}/{{ $id_discution }}',
                type: 'get',
                dataType: 'json',
                success: (response) => {

                    var data = ""
                    if (response.length == 0) {
                        data += 'Demarer votre conversation'
                    } else {
                        for (let i = 0; i < response.length; i++) {
                            var newdate = new Date(response[i].created_at);
                            var d = newdate.toString().split(" ")
                            var date = d[0] + ' ' + d[1] + ' ' + d[3] + ' ' + d[4]
                            if (response[i].from == {{ Auth::user()->id }}) {
                                data +=
                                    '<div class="d-flex align-items-end justify-content-start flex-column mb-2 ">'
                                data +=
                                    '<div style="max-width: 70%;" class=" p-1 left__message">'

                                if (response[i].voice_message) {
                                    data += '<audio  src="{{ asset('audios') }}/' +
                                        response[i].voice_message +
                                        '" controls class=""></audio>'
                                }
                                if (response[i].images) {
                                    data +=
                                        '<div class="d-flex align-items-center flex-wrap justify-content-start" style="gap:5px;max-width:200px" >'

                                    var images = response[i].images.split("|");
                                    for (var j = 0; j < images.length; j++) {
                                        data +=
                                            '<img src="{{ asset('message_photo') }}/' + images[j] +
                                            '" alt="" style="width:60px;height:60px">'

                                    }
                                    data += '</div>'
                                }
                                if (response[i].message) {
                                  
                                    data += ' <span>' + response[i].message + '</span><br>'
                                }

                                data += ' </div>'
                                data +=
                                    '<span style="font-size: 13px" class="text-muted">' + date + '</span>'
                                data +=
                                    '<div class="d-flex align-item-center justify-content-center" style="gap: 10px">'
                                data += '<div class="form-check">'

                                if (response[i].status != 0) {
                                    data +=
                                        '<input class="form-check-input small  rounded-circle shadow-none" readonly type="checkbox" id="check1" name="option1" value="something" checked>'
                                    data +=
                                        '<label class="form-check-label text-muted" style="font-size: 13px">vu</label>'
                                }
                                data += '</div>'
                                data +=
                                    '<a href="javascript:void(0)" id="delete_message" identifient_message="' +
                                    response[i].id +
                                    '"><img src="{{ asset('icones/delete-svgrepo-com.svg') }}" width="15" alt=""></a>'
                                data +=
                                    '<a href="{{ URL::to('partage') }}/' + response[i].id +
                                    '/{{ $id_discution }}/{{ $user_id }}" ><img src="{{ asset('icones/share-2-svgrepo-com.svg') }}" width="20px" alt=""></a>'
                                data += '</div>'
                                data += '</div>'
                            } else {
                                data +=
                                    '<div class="d-flex align-items-start flex-column justify-content-start mb-2">'
                                data +=
                                    ' <div style="max-width: 70%;" class="right__message">'
                                if (response[i].voice_message) {
                                    data += '<audio src="{{ asset('audios') }}/' + response[i].voice_message +
                                        '" controls></audio>'
                                }
                                if (response[i].images) {
                                    data +=
                                        '<div class="d-flex align-items-center flex-wrap justify-content-start" style="gap:5px;max-width:200px" >'

                                    var images = response[i].images.split("|");
                                    for (var j = 0; j < images.length; j++) {
                                        data +=
                                            '<img src="{{ asset('message_photo') }}/' + images[j] +
                                            '" alt="" style="width:60px;height:60px">'

                                    }
                                    data += '</div>'
                                }
                                if (response[i].message) {
                                    data += ' <span>' + response[i].message + '</span><br>'
                                }
                                data += '</div>'
                                data += '<div>'
                                data +=
                                    '<span style="font-size: 13px" class="text-muted">' + date + '</span>'
                                data += '</div></div>'
                            }

                        }
                    }

                    $('.contentMEssage').html(data)
                    var scroll = $('.contentMEssage');
                    scroll.animate({
                        scrollTop: scroll.prop("scrollHeight")
                    });
                },
                error: (error) => {
                    console.log(error)
                }
            })
        }
        $(document).on('click', '#delete_message', function() {
            if (confirm('Vous voulez suprimer cette message')) {
                var identifien_message = $(this).attr('identifient_message')
                $.ajax({
                    url: '{{ URL::to('delete_message') }}/{{ $user_id }}/' + identifien_message,
                    type: 'get',
                    success: () => {
                        show_message()
                    }
                })
            } else {
                return
            }
        })

        $('#search_message').on('input', function() {
            var data = $(this).val()
            if (data) {
                $.ajax({
                    url: '{{ URL::to('searchMessage') }}/{{ $id_discution }}/' + data,
                    type: 'get',
                    dataType: 'json',
                    success: (response) => {
                        resultOfSearch(response)
                    }
                })
            } else {
                show_message()
            }
        })
        $('#form_search_message').on('submit', function(e) {
            e.preventDefault()
            var data = $("#search_message").val()
            if (data) {
                $.ajax({
                    url: '{{ URL::to('searchMessage') }}/{{ $id_discution }}/' + data,
                    type: 'get',
                    dataType: 'json',
                    success: (response) => {
                        resultOfSearch(response)
                    }
                })
            } else {
                show_message()
            }
        })

        function resultOfSearch(response) {
            var data = ""
            if (response.length == 0) {
                data += 'Aucun resultat pour votre recherche'
            } else {
                for (let i = 0; i < response.length; i++) {
                    var newdate = new Date(response[i].created_at);
                    var d = newdate.toString().split(" ")
                    var date = d[0] + ' ' + d[1] + ' ' + d[3] + ' ' + d[4]
                    if (response[i].from == {{ Auth::user()->id }}) {
                        data +=
                            '<div class="d-flex align-items-end justify-content-start flex-column mb-2 ">'
                        data +=
                            '<div style="max-width: 70%;" class="left__message">'

                        if (response[i].voice_message) {
                            data += '<audio  src="{{ asset('audios') }}/' + response[i].voice_message +
                                '" controls></audio>'
                        }
                        if (response[i].images) {
                            data +=
                                '<div class="d-flex align-items-center flex-wrap justify-content-start" style="gap:5px;max-width:200px" >'

                            var images = response[i].images.split("|");
                            for (var j = 0; j < images.length; j++) {
                                data +=
                                    '<img src="{{ asset('message_photo') }}/' + images[j] +
                                    '" alt="" style="width:60px;height:60px">'

                            }
                            data += '</div>'
                        }
                        if (response[i].message) {
                            data += ' <span>' + response[i].message + '</span><br>'
                        }

                        data += ' </div>'
                        data +=
                            '<span style="font-size: 13px" class="text-muted">' + date + '</span>'
                        data +=
                            '<div class="d-flex align-item-center justify-content-center" style="gap: 10px">'
                        data += '<div class="form-check">'

                        if (response[i].status != 0) {
                            data +=
                                '<input class="form-check-input small  rounded-circle shadow-none" readonly type="checkbox" id="check1" name="option1" value="something" checked>'
                            data +=
                                '<label class="form-check-label text-muted" style="font-size: 13px">vu</label>'
                        }
                        data += '</div>'
                        data +=
                            '<a href="javascript:void(0)" id="delete_message" identifient_message="' +
                            response[i].id +
                            '"><img src="{{ asset('icones/delete-svgrepo-com.svg') }}" width="15" alt=""></a>'
                        data +=
                            '<a href="{{ URL::to('partage') }}/' + response[i].id +
                            '/{{ $id_discution }}/{{ $user_id }}" ><img src="{{ asset('icones/share-2-svgrepo-com.svg') }}" width="20px" alt=""></a>'
                        data += '</div>'
                        data += '</div>'
                    } else {
                        data +=
                            '<div class="d-flex align-items-start flex-column justify-content-start mb-2">'
                        data +=
                            ' <div style="max-width: 70%;" class="right__message">'
                        if (response[i].voice_message) {
                            data += '<audio src="{{ asset('audios') }}/' + response[i].voice_message +
                                '" controls></audio>'
                        }
                        if (response[i].images) {
                            data +=
                                '<div class="d-flex align-items-center flex-wrap justify-content-start" style="gap:5px;max-width:200px" >'

                            var images = response[i].images.split("|");
                            for (var j = 0; j < images.length; j++) {
                                data +=
                                    '<img src="{{ asset('message_photo') }}/' + images[j] +
                                    '" alt="" style="width:60px;height:60px">'

                            }
                            data += '</div>'
                        }
                        if (response[i].message) {
                            data += ' <span>' + response[i].message + '</span><br>'
                        }
                        data += '</div>'
                        data += '<div>'
                        data +=
                            '<span style="font-size: 13px" class="text-muted">' + date + '</span>'
                        data += '</div></div>'
                    }

                }
            }
            $('.contentMEssage').html(data)
        }
    </script>
</body>

</html>
