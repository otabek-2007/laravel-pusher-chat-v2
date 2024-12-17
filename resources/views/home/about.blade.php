<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
</head>

<body>

    @include('layout.header_area')
    <div class="container-fluid">
        <div class="container">
            <div class="about-content col-12 row">
                <div class="text-secondary alert alert-secondary col-8">
                    <div class="col-12 pb-3">
                        <h5>About</h5>

                        <p >Ushbu dastur <strong class="text-dark">Otashenko</strong> tomonidan tuzildi. </p>
                        <p>Dastur nomi: <span class="text-danger">Z.Chat</span></p>
                        <p>Dasturning nomidagi: <strong>Z - Zerikish</strong> </p>
                        <p>Dasturning nomidagi: <strong> Chat - (ingliz tilidan olingan bolib 'suhbat') - degan
                                manolarni anglatadi </strong></p>
                        <p>Dastur qobilyatlari: <strong> do`stlar bilan chatting time uyushtirish, post joylash public ravishda
                            (hamma kora oladigan qilib), commentlar qoldirish imkoniyatlari, ha aytgancha ozingizning shaxsiy acountingiz ham boladi </strong></p>
                        <p> <strong class="text-success">Qisqa qilib aytganda telegram, instagram lardan bir shingildan olingan :)</strong></p>
                        <p>Dastur: <strong class="text-success">Laravel 10, javascript, Css, Bootstrap 5, Pusher, Blade va bir qancha kutubxonalar </strong>yordamida tuzildi </p>
                        <p>Dastur moslashuvchanligi: <strong>width: 270px gacha bolgan devicelarga javob beradi. Ammo asosan 15 dyumli va undan yuqori bolgan ekranlarga moslangan</strong></p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="col-12">

                        {{-- <h5 class="text-danger">Bu esa men, ushbu dastur asoschisi</h5> --}}
                        <img src="/storage/about.jpg" height="450px" width="400px"
                            style="display:flex;object-fit: cover" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('layout.footer')

</body>

</html>
