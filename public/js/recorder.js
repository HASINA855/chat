
let chunks=[]
let audioURL=''
let mediaRecorder;

if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia){
    navigator.mediaDevices.getUserMedia({
        audio: true,
    }).then(stream => {
        mediaRecorder = new MediaRecorder(stream)

        mediaRecorder.ondataavailable = (e) => {
            chunks.push(e.data)
        }

        mediaRecorder.onstop = () => {
            const blob = new Blob(chunks, {'type': 'audio/mp3'})
            chunks = []
            // audioURL = window.URL.createObjectURL(blob)
            // document.querySelector('.audio').src = audioURL
            let file = new File([blob], 'Record.mp3',{type:"audio/mp3"}, 'utf-8');
            let container = new DataTransfer(); 
            container.items.add(file);
            document.querySelector('#message_vocal').files=container.files

            var message=$('#send_vocal_message')[0]
            var formdata=new FormData(message)

            
            $.ajax({
                url:'http://127.0.0.1:8000/send__message',
                type:'post',
                data:formdata,
                contentType:false,
                processData:false,
                success:(response)=>{
                    show_message()
                    console.log(response)
                },
                error:(error)=>{
                    console.log(error)
                }
            })
                
          
            // var voice_message= $('#message_vocal').val()
            // var id_chat_with=$('#id_chat').val()
            // var id_discution= $('#id__discution').val()
            // send_message_vocal(voice_message,id_chat_with,id_discution)

        }
    }).catch(error => {
        console.log('Following error has occured : ',error)
    })
}else{
    alert('tesy zaka')
}

$(document).on('click', '.start_record', function() {
    $('.recorder_audio').html(
        '<img src="http://127.0.0.1:8000/icones/record_recorder_stop-512.webp"  width="40" alt="" class="stop_record">'
        )
    $('#recorder_file').show()

    mediaRecorder.start()
})
$(document).on('click', '.stop_record', function() {
    mediaRecorder.stop()
    $('.recorder_audio').html(
        '<img src="http://127.0.0.1:8000/icones/microphone-svgrepo-com-2.svg"  width="20" alt="" class="start_record">'
        )
    $('#recorder_file').hide()
})




