{{-- <!DOCTYPE html>
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
        <h3 class="text-center">Connexion</h3>
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

</html> --}}




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap.min.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('inscription/css/style.css') }}">
</head>


<style>
    .inner {
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        background-image: url('{{ asset("inscription/images/10266305.png") }}');
        height: 90vh;
   width:100%;
        border-top-left-radius: 7px;
        border-bottom-left-radius: 7px;
        
    }

    @media all and (max-width:766px) {
        .inner {
            display: none;
        }
        .content_form{
            border: none!important
        }
    }
</style>

<body>

    <!-- Registration 4 - Bootstrap Brain Component -->
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container ">
            <div class="card border-light-subtle shadow-sm mx-auto" style="height: 90vh;width: 75%">
                <div class="row  rounded ">
                    <div class="col-12 p-0 col-md-6 " style="box-sizing: border-box;">
                        <div class="inner">

                        </div>
                        {{-- <img class="img-fluid rounded-start w-100  object-fit-cover" loading="lazy" src="{{asset("inscription/images/social-media-5187243_960_720.webp")}}"; alt="BootstrapBrain Logo"> --}}
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-center content_form" style="height: 90vh;border-left: 1px solid rgba(128, 128, 128, 0.363)">
                        <div class="card-body  p-xl-5">
                            <div class="row ">
                                <div class="col-12">
                                    <div class="">
                                        <h2 class="h3 text-center">Autentification</h2>

                                    </div>
                                </div>
                            </div>
                            <form class="form_connexion ">
                                <div class="row gy-2 overflow-hidden p-0">
                                    
                                    @csrf
                                   
                                   
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="name@example.com" required>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="password" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            value="" placeholder="Votre mot de passe............." required>
                                    </div>
                                   

                                    <hr class="w-75 mx-auto">
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn bsb-btn-xl btn-primary" type="submit">Se connecter</button>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                       <span style="font-size: 15px" class="text-muted">
                                        Vous n'avez pas un compte <a href="{{URL::to('/s_inscrire')}}">Créer </a>
                                    </span> 
                                    </div>
                                    
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
