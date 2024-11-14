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
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            /* Membatasi lebar card */
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
            /* Membuat tombol lebar penuh */
        }

        .btn-success:hover {
            background-color: #169e28;
            border-color: #3bb14b;
        }

        select,
        input {
            border-radius: 4px;
            /* Memperhalus sudut input */
        }

        .alert-danger {
            background-color: #e19c91ab;
            border-color: #c5a043e0;
            color: #fff;
            display: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Tambah Data</h2>

        <!-- Alert for validation errors (if any) -->
        <div class="alert alert-danger" style="display: none;" id="error-alert">
            <ul id="error-list"></ul>
        </div>

        <form id="create-user-form" action="{{ route('admin.users.store') }}" method="POST">
        @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>

            <!-- Row for Gender and Role -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" class="form-select" name="role" required>
                        <option value="siswa">Siswa</option>
                        <option value="pembimbing">Pembimbing</option>
                        <option value="mitra">Mitra</option>
                        <option value="mentor">Mentor</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" class="form-select" name="gender" required>
                        <option value="">Pilih Gender</option>
                        <option value="male">Laki-laki</option>
                        <option value="female">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Kota</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>

            <button type="submit" class="btn btn-success">Create User</button>
            <br>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>
