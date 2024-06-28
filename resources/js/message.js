import Echo from 'laravel-echo';
import './bootstrap';
import $ from 'jquery';


 var proceccing = window.Echo.channel("processingMessage."+id_discution)
    proceccing.listen('.processingMessage', (e) => {
        $('.processing').css('display', 'block')
        setTimeout(() => {
            $('.processing').hide()
        }, 2000);
    })


const channel = window.Echo.channel("getMessage."+id_discution)
    channel.listen('.GetMessage', (e) => {
        $.ajax({
            url: 'http://127.0.0.1:8000/updateStatusMessage/'+id_discution,
            type: 'get',
        })

        var newdate = new Date();
        var d = newdate.toString().split(" ")
        var date = d[0] + ' ' + d[1] + ' ' + d[3] + ' ' + d[4]
        
        var data = '<div class="d-flex align-items-start flex-column justify-content-start mb-2">'
        data += ' <div style="max-width: 70%;" class="right__message">'
        if (e.voice_message) {
            data += '<audio src="http://127.0.0.1:8000/audios/' + e.voice_message +
                '" controls></audio>'
        }
        if (e.images) {
            data +='<div class="d-flex align-items-center flex-wrap justify-content-start" style="gap:5px;max-width:200px">'
            var images = e.images.split("|");
            for (var j = 0; j < images.length; j++) {
                data +='<img src="http://127.0.0.1:8000/message_photo/' + images[j] +'" alt="" style="width:60px;height:60px">'
            }
            data += '</div>'
        }
        if (e.message) {
            data += ' <span>' + e.message + '</span><br>'
        }
            data += '</div>'
            data += '<div>'
            data += '<span style="font-size: 13px" class="text-muted">' + date + '</span>'
            data += '</div></div>'
        var scroll = $('.contentMEssage');
        scroll.animate({
            scrollTop: scroll.prop("scrollHeight")
        });
        $('.contentMEssage').append(data)
    })