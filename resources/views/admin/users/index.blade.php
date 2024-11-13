<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .table {
            background-color: #fff;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn-success {
            background-color: #17d033;
            border-color: #14b92d;
            color: #fff;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .pagination {
            justify-content: center;
        }

        .btn-success {
             background-color: #17d033;
             border-color: #48d75d;
        }

        .btn-success:hover {
            background-color: #169e28;
            border-color: #3bb14b;
        }


    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Manage Users</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">Add New User</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $users->links() }}
        </div>
    </div>
</body>

</html>
