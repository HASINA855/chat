<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap.min.js') }}" defer></script>
    @vite('resources/js/inscription.js')
</head>

<body style="height: 100vh" class="d-flex align-items-center justify-content-center">
    <form class="w-25 rounded shadow p-2 form_inscription">
        <h3 class="text-center">Inscription</h3>
        <hr>
        @csrf
        <div class="d-flex justify-content-center mx-auto mb-2" style="position: relative;width:100px">
            <div>
                <img id="image_name" src="{{ asset('icones/user-avatar-profile-person-people-svgrepo-com.svg') }}"
                    style="width: 70px;height: 70px;" class="bg-light shadow rounded-circle p-2" alt="">
            </div>
            <label for="p_profile" style="cursor: pointer ;position: absolute ;bottom: 0;right: 0;">
                <img src="{{ asset('icones/photo-camera-svgrepo-com.svg') }}" width="30" alt="camera">
            </label>
        </div>
        <input type="file" name="p_profile" id="p_profile" onchange="display_image(this)" hidden>
        <input type="text" name="nom" class="form-control mb-2" id="" placeholder="Entrer votre nom">
        <input type="text" name="prenom" class="form-control mb-2" id="" placeholder="Entrer votre prenom">
        <input type="email" name="email" class="form-control mb-2" id="" placeholder="Entrer votre email">
        <input type="password" name="password" class="form-control mb-2" id=""
            placeholder="Entrer votre password">
        <input type="password" name="confirmation" class="form-control mb-2" id="" placeholder="Confirmer">
        <hr>
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>

    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    <script>
         function display_image(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_name').attr('src', e.target.result)
                      
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }

            $('.form_inscription').on('submit',function(e){
    e.preventDefault()

    var data=$(this)[0];
    var formData=new FormData(data)

    $.ajax({
        url:'{{URL::to("createUser")}}',
        type:'post',
        data:formData,
        contentType:false,
        processData:false,
        success:(response)=>{
            if(response.success){
                alert(response.success)
                data.reset()
                window.location.href="{{URL::to('connexion')}}"
            }
        },
        error:(error)=>{
            console.log(error)
        }

    })
})
    </script>
</body>

</html>
