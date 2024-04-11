@include('header')

<section>
  @if(session('success_song'))
  <div class="alert  alert-success" role="alert">
  {{session('success_song')}}
</div>
  @endif
  @if(session('error_song'))
  <div class="alert  alert-danger" role="alert">
  {{session('error_song')}}
  </div>
  @endif
  @if(session('delete_success'))
  <div class="alert  alert-success" role="alert">
  {{session('delete_success')}}
  </div>
  @endif
    @if(session('success'))
    <div class="alert  alert-success" role="alert">
    {{session('success')}}
    </div>
    @endif
    @if(session('success_redact'))
    <div class="alert alert-success" role="alert">
    {{session('success_redact')}}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="h1-container">
        <h1>Личный кабинет</h1>
    </div>
        {{-- @foreach ($user as $itemm)
    <div class="personal-container">
      <div class="avatar-container">
        <img src="/public/storage/{{$itemm->avatar}}" alt="">
      </div>
      <div class="info-container">
        <ul>
          <li><p>Псевдоним: {{$itemm->login}}</p></li>
          <li><p>Логин: {{$itemm->login}}</p></li>
        @endforeach
        </ul>
      </div>
    </div> --}}

<div class="add-song-container">
    <a class="btn2 pointer center-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
       Добавить песню
    </a>
</div>
    <div class="lk-content-container">
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
                <div class="song-actions">
                    <a href="/song_redact/{{$item->id}}" class="btn1">
                        Редактировать
                    </a>
                    <a href="/song_delete/{{$item->id}}" class="btn1">
                        Удалить
                    </a>
                </div>
              </div>
              @endforeach
              @endif
        </div>

    </div>
</div>

</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" style="text-align: center" id="exampleModalLabel">Добавить песню</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-sign" action="/add_song" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-3">
              <input placeholder="Название песни" required type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="image">Обложка(jpeg, jpg, png)</label>
              <input placeholder="Обложка" type="file" name="image" class="form-control" id="image">
            </div>
            <div class="mb-3">
                <label for="image">Песня(mp3)</label>
              <input placeholder="Песня" required type="file" name="song" class="form-control" id="song">
            </div>
            <div class="mb-3">
              <label for="image">Жанр</label>
            <select required name="genre" id="genre">
              @foreach ($genres as $genre)
                <option value="{{$genre->id}}">{{$genre->title}}</option>
              @endforeach
            </select>
          </div>
            <button class="btn2" type="submit" class="btn btn-primary">Добавить песню</button>
          </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
</body>
</html>