import Echo from 'laravel-echo';
import './bootstrap';
import $ from 'jquery';

const load_discution = window.Echo.channel("listen_discution."+id_user)
        load_discution.listen('.listen_discution', (e) => {
            // console.log(e)
            $('.main').load('listeMyMessage')
            $('.listOf_discution').load('liste0fdiscution')
})
