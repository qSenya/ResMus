@include('header')  

<div class="h1-container">
    <h1>Админ панель</h1>
</div>
@if(session('success_add'))
<div class="alert  alert-success" role="alert">
{{session('success_add')}}
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
<div class="add-song-container">
    <a class="btn2 pointer center-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
       Добавить жанр
    </a>
</div>

<section>



  <div class="lk-content-container">
    <div class="song-container">
        @if ($complaints !== null)
        @foreach ($complaints as $complaint)
        <div class="card" style="max-height:1000px">
             <div class="card-body" style="max-height:1000px">
                <p class="card-text" style="max-height:1000px">Почта отправителя:{{$complaint->email}}</p>
                <p class="card-text" style="max-height:1000px">Суть жалобы:{{$complaint->comment}}</p>
                <p class="card-text" style="max-height:1000px">Исполнитель:{{$complaint->nickname}}</p>
                <p class="card-text" style="max-height:1000px">Песня:{{$complaint->name}}</p>
                <p class="card-text" style="max-height:1000px">Статус:{{$complaint->title}}</p>
              </div>
            <audio src="/storage/{{$complaint->song}}" controls></audio>
            @if ($complaint->status_id === 1)
            <div class="song-actions">
                <a href="/complaint/{{$complaint->complaint_id}}/accept" class="btn1">
                    Принять
                </a>
                <a href="/complaint/{{$complaint->complaint_id}}/decline" class="btn1">
                    Отклонить
                </a>
            </div>
            @endif  
        </div>
          @endforeach
          {{ $complaints->withQueryString()->links('pagination::bootstrap-5') }}
          @endif
    </div>
</div>

</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" style="text-align: center" id="exampleModalLabel">Добавить Жанр</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-sign" action="/add_genre" enctype="multipart/form-data" method="get">
            @csrf
            <div class="mb-3">
              <input placeholder="Название жанра" required type="text" name="genre" class="form-control" id="genre">
            </div>
            <button class="btn2" type="submit" class="btn btn-primary">Добавить жанр</button>
          </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

</body>
</html>