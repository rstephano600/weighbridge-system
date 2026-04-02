<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">
    <div class="row vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4">

            <div class="card shadow-lg border-0">
                <div class="card-body p-4">

                    <h4 class="text-center mb-4">Login</h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">Login</button>

                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>