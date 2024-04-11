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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" style="text-align: center" id="exampleModalLabel">Добавить Жанр</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-sign" action="/add_genre" enctype="multipart/form-data" method="post">
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