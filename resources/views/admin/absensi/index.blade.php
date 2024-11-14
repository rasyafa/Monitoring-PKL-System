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
            color: #272727;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .table {
            background-color: #17d033;
            min-width: 800px;
            /* Ensure the table is wide enough to trigger scroll */
        }

        .table thead th {
            background-color: #17d033;
            color: #fff;
            text-align: center;
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
         .btn-success {
            background-color: #17d033;
            border-color: #48d75d;
        }

        .btn-success:hover {
            background-color: #169e28;
            border-color: #3bb14b;
        }

        /* Style untuk pagination */
       .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item.active .page-link {
            background-color: #17d033;
            border-color: #17d033;
            color: white;
        }

        .pagination .page-item .page-link {
            color: #17d033;
            border: 1px solid #17d033;
        }

        .pagination .page-item:hover .page-link {
            background-color: #169e28;
            border-color: #169e28;
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
            border-color: #ccc;
        }

        .pagination .page-item .page-link {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }



        /* Responsiveness adjustments */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                /* Enable horizontal scrolling */
                -webkit-overflow-scrolling: touch;
                /* Smooth scrolling for iOS */
                -ms-overflow-style: none;
                /* Hide scrollbar in IE/Edge */
                scrollbar-width: none;
                /* Hide scrollbar in Firefox */
            }

            .table-responsive::-webkit-scrollbar {
                display: none;
                /* Hide scrollbar in Webkit browsers */
            }

            h2 {
                font-size: 1.5rem;
            }

            .btn-success {
                font-size: 0.9rem;
                padding: 0.5rem 1rem;
            }

            .table td,
            .table th {
                padding: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Data Absensi</h2>
        <a href="#" class="btn btn-success mb-3">Add New User</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>2023-11-21</td>
                        <td>Sakit</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Doe</td>
                        <td>2023-11-22</td>
                        <td>Izin</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>
