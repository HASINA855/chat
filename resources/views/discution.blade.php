<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>discution</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap.min.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/emojionearea.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
   
</head>
<style>
    * {
        scrollbar-color: #95a5a6 #ecf0f1;
        scrollbar-width: thin;
        scroll-behavior: smooth
    }
    
    
</style>

<body class="d-flex align-items-center justify-content-center" style="height: 100vh">
    @include('animate')
    <div class="card mx-sm-2 mx-2">
        <div class="main">
            @include('navbar')
        </div>
        <div class="my_discution">
            <div class="card-body listOf_discution " style="height: 70vh;overflow-y: auto">
                @include('listeDiscution')
            </div>
        </div>
    </div>
    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    <script>
        window.id_user = {{ Auth::user()->id }}
        $('.toggle_menu').on('click', function() {
            $('.menu').slideToggle()
        })
        $('#form_search_discution').on('submit', function(e) {
            e.preventDefault()
            var data = $('#search_discution').val()
            if (data) {
                $('.listOf_discution').load('resultDiscution/' + data)
            } else {
                $('.listOf_discution').load('liste0fdiscution')
            }
        })
        $('#search_discution').on('input', function() {
            var data = $(this).val()
            if (data) {
                $('.listOf_discution').load('resultDiscution/' + data)
            } else {
                $('.listOf_discution').load('liste0fdiscution')
            }
        })
        $(document).on('click', '.chatWith', function() {
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
    </script>
     @vite('resources/js/listeDiscution.js')
    <script src="{{ asset('js/all.min.js') }}"></script>
</body>

</html>
