<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>


    <div class="container">
        <div class="display"></div>
        <div class="controllers"></div>
    </div>

    <form enctype="multipart/form-data" id="form_audio">
        @csrf
        <input type="file" id="audio" name="audio">
        <button>Enregistrer</button>
    </form>

    
<script src="{{asset('jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('vrecorder.js')}}"></script>

    <script>
        $('#form_audio').on('submit',function(e){
            e.preventDefault()
            var data=$(this)[0]
            var formData=new FormData(data)
            $.ajax({
                url:'store_audio',
                type:'post',
                data:formData,
                contentType:false,
                processData:false,
                success:(response)=>{
                    console.log(response)
                }
            })
        })
    </script>
</body>
</html>