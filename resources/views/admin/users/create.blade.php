<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
         body {
            background-color: #f1f1f1;
            font-family: sans-serif;
        }

        .container {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .form-label {
            color: #333;
        }

        .btn-primary {
            background-color: #2ecc71;
            border-color: #27ae60;
            color: #fff;
        }

        .alert-danger {
            background-color: #e19c91ab;
            border-color: #c5a043e0;
            color: #fff;
        }

        .btn-success {
             background-color: #17d033;
             border-color: #48d75d;
        }

        .btn-success:hover {
            background-color: #169e28; /* Warna latar belakang saat hover */
            border-color: #3bb14b;     /* Warna border saat hover */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Create New User</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" value="{{ old('username') }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select id="role" class="form-select" name="role">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Create User</button>
        </form>
    </div>
</body>

</html>
