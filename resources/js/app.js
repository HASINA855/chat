import Echo from 'laravel-echo';
import './bootstrap';


const channel=window.Echo.channel('public.playground.1')
channel.listen('.playground',(e)=>{
    console.log(e)
})


