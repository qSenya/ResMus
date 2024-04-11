@include('header')

    <section>
      
        @if(session('success_complaint'))
        <div class="alert  alert-success" role="alert">
        {{session('success_complaint')}}
        </div>
        @endif
        <div class="block1-container">
            <div class="block1-image-container">
                <img class="block1-image" src="/storage/img/music-svgrepo-com.svg" alt="">
            </div>
            <div class="block1-text-container">
                <p><h2>Загружай</h2> собственные или <h2>слушай песни</h2> своих любимых исполнителей</p>
            </div>
        </div>
    </section>
    <section style="margin-bottom: 75px">
        <div class="h1-container">
            <h1>Новинки</h1>
        </div>

        <div class="song-container">
            @if ($songs !== null)
            @foreach ($songs as $item)
            <div class="card">
                <img src="/storage/{{$item->image}}" class="song-image" alt="...">
                <div class="card-body">
                    <p class="card-text">{{$item->nickname}}</p>
                    <p class="card-text">{{$item->name}}</p>
                </div>
                <audio src="/storage/{{$item->song}}" controls></audio>
                @auth
                <a href="/complaint/{{$item->id}}" class="btn1 red">Пожаловаться</a>
                @endauth
              </div>
              @endforeach
              @endif
        </div>
    </section>
</body>
</html>