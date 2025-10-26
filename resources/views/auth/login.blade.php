<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
   @vite(['resources/css/app.css', 'resources/js/app.js'])
<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh">
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-body p-4">
          <h4 class="mb-3 text-center">Đăng nhập</h4>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
              <label class="form-label">Mật khẩu</label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3 d-flex justify-content-between">
              <div><input type="checkbox" name="remember" id="remember"> <label for="remember">Ghi nhớ</label></div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</body>
</html>
