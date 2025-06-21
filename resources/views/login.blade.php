{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Panel - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body 
    class="bg-light"
    style="background: url('https://d2nytdlptrqhdi.cloudfront.net/wp-content/uploads/2023/11/29104111/Checklist-o-que-e-como-fazer.jpg') center/cover no-repeat"
>
  <div class="container vh-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow">
          <div class="card-body p-4">
            <h5 class="card-title text-center mb-4">Login</h5>
            <form method="POST" action="{{ route('login') }}">
              @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        required autofocus
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required
                    >
                </div>

                @if ($errors->has('auth'))
                    <div class="alert alert-danger">
                        {{ $errors->first('auth') }}
                    </div>
                @endif

              {{-- <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                 <label class="form-check-label" for="remember">
                  Lembrar-me
                </label> 
              </div> --}}

              <button type="submit" class="btn btn-primary w-100">Log In</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => {
                const alert = document.querySelector('.alert.alert-danger');
                if (alert) {
                    alert.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
