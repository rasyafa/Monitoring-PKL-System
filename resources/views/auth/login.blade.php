<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-gray-100 {
            background-color: #f7fafc;
        }
        .bg-green-100 {
            background-color: #c3e6cb;
        }
        .text-green-700 {
            color: #155724;
        }


        .btn-custom {
            background-color: #03d703;
            border-color: #03d703;
            color: #ffffff;
            box-shadow: none;
        }

        .btn-custom:hover {
            background-color: #02c702;
            border-color: #02c702;
            color: #ffffff;
            box-shadow: none;
        }

        .btn-custom:focus, .btn-custom:active {
            background-color: #02c702;
            border-color: #02c702;
            color: #ffffff;
            box-shadow: none;
        }


        .text-primary, .text-primary:hover, .text-primary:focus {
            color: #03d703 !important;
        }

        .text-primary:hover {
            color: #02c702 !important;
        }


        .form-control:focus {
            border-color: #03d703;
            box-shadow: none;
        }


        .form-check-input {
            background-color: #ffffff;
            border-color: #03d703;
        }

        .form-check-input:checked {
            background-color: #03d703;
            border-color: #03d703;
        }

        .form-check-input:focus {
            border-color: #03d703;
            box-shadow: none;
        }


        .form-check-label {
            color: #686868;
        }

        .form-check-input:checked ~ .form-check-label {
            color: #686868;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="col-md-4 bg-white rounded-lg shadow-lg p-4">


            <div id="successMessage" class="alert alert-success d-none" role="alert">
                <span id="successText"></span>
            </div>

            <h2 class="text-center mb-4">Masuk</h2>

            <form action="/login" method="POST" id="loginForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                <div class="form-group">
                    <label for="username">Nama pengguna</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                    <div class="invalid-feedback" id="usernameError"></div>
                </div>


                <div class="form-group">
                    <label for="password">Kata sandi</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <div class="invalid-feedback" id="passwordError"></div>
                </div>


                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Ingat Saya</label>
                </div>


                <button type="submit" class="btn btn-custom btn-block mt-4">Masuk</button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-muted">
                    Belum punya akun?
                    <a href="/register" class="text-primary">Daftar di sini</a><br>
                    <a href="/" class="text-primary">Kembali ke Beranda</a>
                </p>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = '{{ session('success') }}';

            if (successMessage) {
                document.getElementById('successMessage').classList.remove('d-none');
                document.getElementById('successText').textContent = successMessage;
            }
        });


        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let valid = true;


            document.getElementById('usernameError').textContent = '';
            document.getElementById('passwordError').textContent = '';
            document.getElementById('username').classList.remove('is-invalid');
            document.getElementById('password').classList.remove('is-invalid');


            if (document.getElementById('username').value.trim() === '') {
                document.getElementById('usernameError').textContent = 'Username is required';
                document.getElementById('username').classList.add('is-invalid');
                valid = false;
            }
            if (document.getElementById('password').value.trim() === '') {
                document.getElementById('passwordError').textContent = 'Password is required';
                document.getElementById('password').classList.add('is-invalid');
                valid = false;
            }

            if (valid) {
                alert('Form submitted successfully!');
                this.submit();
            }
        });
    </script>

</body>
</html>
