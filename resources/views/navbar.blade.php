<div class="card-header">
    <div class="d-flex align-item-center flex-wrap justify-content-between" style="gap:20px" >
        <div class="d-flex align-items-center justify-content-start flex-wrap" style="gap: 10px">
            <div style="position: relative">
                <img src="{{ asset('profile_users/' . Auth::user()->profile) }}"
                    style="width: 50px;height:50px;cursor: pointer"
                    class="rounded-circle shadow p-2 toggle_menu" alt="">
                <div class="bg- shadow menu" style="position: absolute;display: none">
                    <div class="list-group">
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex align-item-center justify-content-start"
                            style="gap: 10px"><img src="{{ asset('icones/cog-svgrepo-com-1.svg') }}"
                                width="20" alt="">Parametre</a>
                        <a href="{{ URL::to('deconnexion') }}"
                            class="list-group-item list-group-item-action d-flex align-item-center justify-content-start"
                            style="gap: 10px"><img src="{{ asset('icones/logout-svgrepo-com.svg') }}"
                                width="20" alt="">Deconnexion</a>

                    </div>
                </div>
            </div>
            <b>{{ Auth::user()->nom }}</b>
            <a href="" style="position: relative;" class="d-flex align-itme-start py-2"><img src="{{ asset('icones/messenger-facebook-svgrepo-com.svg') }}" width="20"
                    alt="">
                <span class="btn btn-danger count__message p-1 shadow-none rounded-circle d-flex align-items-center" style="height: 15px;width: 15px;position: absolute;top:0;font-size: 10px;display: none!important"></span>
                </a>
        </div>
        <div class="d-flex align-items-center justify-content-start flex-wrap" style="gap: 10px">
            <form id="form_search_discution">
                <div class="input-group rounded-pill">
                    <input type="text" id="search_discution" class="form-control form-control-sm shadow-none"
                        placeholder="Recherche .......">
                    <button class="input-group-text" type="submit"><img
                            src="{{ asset('icones/search-left-1504-svgrepo-com.svg') }}" width="10"
                            alt=""></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
<script>
   count()
        function count() {
            $.ajax({
                url: '{{ URL::to('count_my_message') }}',
                type: 'get',
                success: (response) => {
                    if (response != 0) {
                        $('.count__message').show()
                        $('.count__message').text(response)
                    }
                    // console.log(response)
                }
            })
        }
</script>