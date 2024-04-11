@include('header')

<section>
  @if(session('success_delete_complaint'))
  <div class="alert  alert-success" role="alert">
  {{session('success_delete_complaint')}}
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
<div class="add-song-container">
  <ul class="lk-nav">
     <li> 
       <a class="btn2 pointer center-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
       Добавить песню
       </a>
    </li>
    <li> 
      
      <a class="btn2 pointer center-btn" href="/complaints">
      Посмотреть список своих жалоб
      </a>
  </li>
  </ul>
   
</div>
    <div class="lk-content-container">
        <div class="song-container">
            @if ($complaints !== null)
            @foreach ($complaints as $item)
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