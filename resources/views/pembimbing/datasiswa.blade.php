<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for color */
        .thead-custom {
            background-color: #03d703;
            color: white;
        }

        /* Custom pagination styles */
        .pagination .page-link {
            color: #03d703; /* Green text for pagination */
        }

        .pagination .page-item.active .page-link {
            background-color: #03d703;
            border-color: #03d703;
            color: white; /* White text for active page */
        }

        .pagination .page-link:hover {
            background-color: #e0ffe0; /* Light green on hover */
            color: #03d703;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d; /* Default disabled color */
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <h3 class="text-center">Data Siswa</h3>
        <!-- Tabel Data Siswa dengan jarak lebih banyak -->
        <div class="table-responsive mt-5">
            <table class="table table-bordered table-striped text-center">
                <thead class="thead-custom">
                    <tr>
                        <th>Id</th>
                        <th>Nama Siswa</th>
                        <th>User Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Agus Rahman</td>
                        <td>agus_rahman</td>
                        <td>agus.rahman@example.com</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination Section -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">></a>
            </li>
        </ul>
    </nav>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
