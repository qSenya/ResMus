@include('header')

<section>
    <div class="h1-container">
        <h1>Редактирование песни</h1>
    </div>
      <div class="form-container">
        <form class="form-sign" action="/redact/{{$song->id}}" method="post" enctype="multipart/form-data">
          @csrf 
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
            <div class="mb-3">
              <label for="name" class="form-label">Название</label>
              <input type="text" name="name" pattern="[A-Za-z0-9]+" class="form-control" id="name" value="{{$song->name}}">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Обложка</label>
              <img style="width: 75px" src="/storage/{{$song->image}}" alt="">
              <input type="hidden" name="image_last" class="form-control" id="image_last-last" value="{{$song->image}}">
              <input style="margin-top: 15px" type="file" name="image" class="form-control" id="image">
            </div>
            <button class="btn2" type="submit" class="btn btn-primary">Редактировать</button>
          </form>
        </div>
    </section>

</body>
</html>