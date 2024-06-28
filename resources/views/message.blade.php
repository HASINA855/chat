<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    @vite('resources/js/message.js')
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>

<body style="height: 100vh" class="w-100 d-flex align-items-center justify-content-center bg-danger">

    <div class="card" class="w-50">
        <div class="card-header d-flex align-items-center" style="gap: 10px">
            <div style="width: 50px;height:50px" class="rounded-circle shadow">

            </div>
            <b>User</b>
        </div>
        <div class="card-body liste_message" style="max-height: 50vh;min-height: 50vh;overflow-y: scroll">

        </div>
        <div class="card-footer">
            <form id="send_message" class="d-flex" style="gap: 10px">
                @csrf
                <input type="text" name="message" id="" class="form-control">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>



    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#send_message').on('submit', function(e) {
                e.preventDefault()
                var data = $(this)[0]
                var formData = new FormData(data)

                $.ajax({
                    url: '{{ URL::to('send_message') }}',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        data.reset()
                        // console.log(response)
                    },
                    error: (error) => {
                        console.log(error)
                    }
                })
            })
        })
    </script>

</body>

</html>
