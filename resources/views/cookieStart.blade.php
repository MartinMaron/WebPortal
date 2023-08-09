<style>
    .cookis-box {
    background: #ffffff;
    color: #070707;
    opacity: 0.8;
    width: 25%;
    top: 50%;
    z-index: 9999;
    height: 200px;
    position: fixed;
    text-align: center;
    margin-left: 37.5%;
    }
</style>


<script type="text/javascript">


$(document).ready(function(){
    $("#boxcookieInput").modal('show');
    $("#boxcookieInput").of('click');

const nameCookis = '{{ $cookis[1] }}';
const coc        = '{{ $cookis[0] }}';

$(".close-cookis").click(function(){
    location.href='https://google.de'
});

$(".accept-cookis").click(function(){
    setCookis(nameCookis);
$("#boxcookieInput").modal('hide');
$(".cookis-box").hide();
});

    function setCookis(name) {
        const value = '{{ $cookis[2] }}';

        document.cookie = name + '=' + value
            + '; max-age='+(360 * 24 * 60 * 60)
            + '; path=/'
            + '; samesite= Lax';

    }

});


</script>


<div class="cookis-box border-2 rounded-lg border-sky-100">
    <div class="cookis-history">
        <i class="bi bi-clock-history"></i>
    </div>
    <div class="container">
        <div class="modal bg-dark text-black-50 " tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-secondary">
                    <div class="modal-header bg-sky-100">
                        <h5 class="modal-title pt-5 sm:text-sm md:text-xl" id="exampleModalLabel">Polityka Prywatnoci Cookis</h5>
                        <button type="button" class="btn-close close-cookis" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-2">
                        <p>Witaj!.</p>
                        <p>Jezeli chcesz zostac i przegladac dalej strone to zakceptuj (Cokie!).</p>
                        <p>Cala Polityka Prywatnosci tu. <a href="Polityka Prywatnosci">Polityka Prywatnosci</a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning close-cookis border-2 rounded-lg border-sky-100 px-2 bg-sky-200" data-bs-dismiss="modal">Nie zezwalaj na cookis!</button>
                        <button type="button" class="btn btn-success accept-cookis border-2 rounded-lg border-sky-100 px-2 bg-sky-200">Zezwalaj na cookis!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
