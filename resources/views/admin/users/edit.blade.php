<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f1f1;
            font-family: sans-serif;
        }

        .container {
            padding: 15px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }

        h2 {
            color: #272727;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .form-label {
            color: #333;
        }

        .btn-success {
            background-color: #17d033;
            border-color: #48d75d;
            width: 100%;
        }

        .btn-success:hover {
            background-color: #169e28;
            border-color: #3bb14b;
        }

        .alert-danger {
            background-color: #e19c91ab;
            border-color: #de8d8dbe;
            color: #fff;
            margin-bottom: 15px;
        }

        .form-control,
        .form-select {
            padding: 8px;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Data</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
            </div>

            <!-- Username Field -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="{{ old('username', $user->username) }}">
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <!-- Password Confirmation Field -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <!-- Role Field -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role">
                        <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="pembimbing" {{ old('role', $user->role) == 'pembimbing' ? 'selected' :
                            ''}}>Pembimbing</option>
                        <option value="mitra" {{ old('role', $user->role) == 'mitra' ? 'selected' : '' }}>Mitra</option>
                        <option value="mentor" {{ old('role', $user->role) == 'mentor' ? 'selected' : '' }}>Mentor
                        </option>
                    </select>
                </div>
                <!-- Gender Field -->
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender">
                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : ''}}>Laki-Laki
                        </option>
                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : ''}}>Perempuan
                        </option>
                    </select>
                </div>
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $user->email) }}">
            </div>

            <!-- City Field -->
            <div class="mb-3">
                <label for="city" class="form-label">Kota</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $user->city) }}">
            </div>

            <!-- Submit and Cancel Buttons -->
            <button type="submit" class="btn btn-success">Update User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>
