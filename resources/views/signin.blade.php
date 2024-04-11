@include('header')


<section>
<div class="h1-container">
    <h1>Авторизация</h1>
</div>
  <div class="form-container">
    <form class="form-sign" action="/signin_validate" method="POST">
      @csrf
            
      @if(session('success_reg'))
      <div class="alert alert-success" role="alert">
      {{session('success_reg')}}
      </div>
      @endif
      @error('confirm_pass')
      <div class="alert alert-danger" role="alert">{{ $message }}</div>
    @enderror
      @if(session('error'))
      <div class="alert alert-danger" role="alert">
      {{session('error')}}
      </div>
      @endif
        <div class="mb-3">
          <label for="login" class="form-label">Логин</label>
          <input type="text" name="login" class="form-control" id="login">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Пароль</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button class="btn2" type="submit" class="btn btn-primary">Войти</button>
        <a class="btn-primary btn1 pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Зарегистрироваться
        </a>
      </form>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" style="text-align: center" id="exampleModalLabel">Регистрация</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-sign" action="/reg_validate" enctype="multipart/form-data" method="post">
          @csrf
          @if(session('error_reg'))
          <div class="alert alert-danger" role="alert">
          {{session('error_reg')}}
          </div>
          @endif
          <div class="mb-3">
            <input placeholder="Логин(должен быть уникальным)" required type="text" name="login" class="form-control" id="login">
          </div>
          <div class="mb-3">
            <input placeholder="Ник(должен быть уникальным)" required type="text" name="nickname" class="form-control" id="nickname">
          </div>
          <div class="mb-3">
            <input placeholder="Пароль" type="password" required name="password" class="form-control" id="password">
          </div>
          <div class="mb-3">
            <input placeholder="Повторите пароль" required type="password" name="confirm_pass" class="form-control" id="confirm_pass">
          </div>
          <button class="btn2" type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

</body>
</html>