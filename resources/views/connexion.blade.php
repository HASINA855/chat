<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap.min.js') }}" defer></script>
</head>

<body style="height: 100vh" class="d-flex align-items-center justify-content-center">
    <form class="w-25 rounded shadow p-2 form_connexion">
        <h3 class="text-center">Connex</h3>
        <hr>
        @csrf
        <input type="text" name="email" class="form-control mb-2" id="" placeholder="Votre email">
        <input type="password" name="password" class="form-control" id="" placeholder="Votre password">
        <hr>
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>


    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    <script>
        $('.form_connexion').on('submit', function(e) {
            e.preventDefault()
            var data = $(this)[0]
            var formData = new FormData(data)
            $.ajax({
                url: '{{ URL::to('Se_connecter') }}',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {

                    if (response.success) {
                        window.location.href = "{{ URL::to('discution') }}"
                    } else if (response.error) {
                        console.log(response.error)
                    }
                },
                error: (error) => {
                    console.log(error)
                }
            })
        })
    </script>

</body>

</html>
