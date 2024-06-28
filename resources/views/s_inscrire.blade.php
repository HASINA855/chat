

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
        background-image: url('{{ asset('inscription/images/10266305.png') }}');
        height: 90vh;
        color: white;
        border-top-left-radius: 7px;
        border-bottom-left-radius: 7px
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
                <div class="row  rounded">
                    <div class="col-12 col-md-6 inner">
                        {{-- <img class="img-fluid rounded-start w-100  object-fit-cover" loading="lazy" src="{{asset("inscription/images/social-media-5187243_960_720.webp")}}"; alt="BootstrapBrain Logo"> --}}
                    </div>
                    <div class="col-12 col-md-6 content_form" style="height: 90vh;border-left: 1px solid rgba(128, 128, 128, 0.363)">
                        <div class="card-body  p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="">
                                        <h2 class="h3 text-center">Inscription</h2>

                                    </div>
                                </div>
                            </div>
                            <form class="form_inscription">
                                <div class="row overflow-hidden p-0">
                                    <div class="d-flex justify-content-center mx-auto mb-2"
                                        style="position: relative;width:100px">
                                        <div>
                                            <img id="image_name"
                                                src="{{ asset('icones/user-avatar-profile-person-people-svgrepo-com.svg') }}"
                                                style="width: 70px;height: 70px;"
                                                class="bg-light shadow rounded-circle p-2" alt="">
                                        </div>
                                        <label for="p_profile"
                                            style="cursor: pointer ;position: absolute ;bottom: 0;right: 0;">
                                            <img src="{{ asset('icones/photo-camera-svgrepo-com.svg') }}" width="30"
                                                alt="camera">
                                        </label>
                                    </div>
                                    @csrf
                                    <input type="file" name="p_profile" id="p_profile" onchange="display_image(this)"
                                        hidden>
                                    <div class="col-12">
                                        <label for="firstName" class="form-label">First Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nom" id="firstName"
                                            placeholder="First Name" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="lastName" class="form-label">Last Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="prenom" id="lastName"
                                            placeholder="Last Name" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="name@example.com" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            value="" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Confirmation <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="confirmation" id="cpassword"
                                            value="" required>
                                    </div>

                                    <div class="col-12 my-2">
                                        <div class="d-grid">
                                            <button class="btn bsb-btn-xl btn-primary" type="submit">Sign up</button>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                       <span style="font-size: 15px" class="text-muted">
                                        Avez-vous déja un compte <a href="{{URL::to('/')}}">Se connecter</a>
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
        function display_image(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image_name').attr('src', e.target.result)

                }
            }
            reader.readAsDataURL(input.files[0]);
        }

        $('.form_inscription').on('submit', function(e) {
            e.preventDefault()

            var data = $(this)[0];
            var formData = new FormData(data)

            $.ajax({
                url: '{{ URL::to('createUser') }}',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response.success) {
                        alert(response.success)
                        data.reset()
                        window.location.href = "{{ URL::to('/') }}"
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
