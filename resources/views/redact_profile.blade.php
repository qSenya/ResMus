@include('header')

<section>
    <div class="h1-container">
        <h1>Сменить пароль</h1>
    </div>
      <div class="form-container">
        <form class="form-sign" action="/redact_profile/{{$user->id}}" method="post" enctype="multipart/form-data">
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
                <input placeholder="Пароль" type="password" pattern="[A-Za-z0-9]+" required name="password" class="form-control" id="password">
              </div>
              <div class="mb-3">
                <input placeholder="Повторите пароль" required type="password" name="confirm_pass" class="form-control" id="confirm_pass">
              </div>
            <button class="btn2" type="submit" class="btn btn-primary">Сменить пароль</button>
          </form>
        </div>
    </section>

</body>
</html>