@include('header')

    <section>
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
    </section>
    <section>
        <div class="h1-container">
            <h1>Жалоба</h1>
        </div>

    </section>
           <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
              <form class="form-sign" action="/create_complaint" enctype="multipart/form-data" method="get">
                @csrf
                <input type="hidden" name="song_id" value="{{$song}}">
                <div class="mb-3">
                    <textarea placeholder="Изложите суть жалобы" type="text-area" name="comment" class="form-control" id="comment" cols="30" rows="10"></textarea>
                </div>
                <button class="btn2" type="submit" class="btn btn-primary">Отправить</button>
              </form>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
</body>
</html>