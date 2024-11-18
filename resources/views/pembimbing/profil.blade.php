<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mentor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .profile-header {
            background-color: #ffffff;
            color: #333333;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .profile-header img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 5px solid #03d703;
            cursor: pointer;
            margin-bottom: 20px;
            transition: all 0.3s ease-in-out;
        }

        .profile-header img:hover {
            transform: scale(1.1);
        }

        .profile-header h2 {
            font-size: 1.75rem;
            margin-bottom: 5px;
            color: #03d703;
        }

        .profile-header p {
            font-size: 1rem;
            color: #666666;
            margin-bottom: 20px;
        }

        .profile-header button {
            background-color: #03d703;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .profile-header button:hover {
            background-color: #028a02;
        }

        .profile-info {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 35px;
            margin-top: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .profile-info h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #03d703;
        }

        .profile-info ul {
            list-style: none;
            padding: 0;
            font-size: 1.1rem;
            color: #555555;
        }

        .profile-info ul li {
            padding: 12px 0;
            border-bottom: 1px solid #f2f2f2;
        }

        .profile-info ul li:last-child {
            border-bottom: none;
        }

        .btn-custom {
            background-color: #03d703;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-size: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #028a02;
        }

        .btn-save {
            background-color: #03d703;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-size: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background-color: #028a02;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Header Profil -->
        <div class="profile-header">
            <img id="profileImage" src="https://via.placeholder.com/120" alt="Foto Profil" data-bs-toggle="modal"
                data-bs-target="#editPhotoModal">
            <h2 id="profileName">Nama Mentor</h2>
            <p>Jabatan: Pembimbing</p>
            <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit
                Profil</button>
        </div>

        <!-- Informasi Profil -->
        <div class="profile-info">
            <h3>Informasi Pribadi</h3>
            <ul>
                <li><strong>Email:</strong> mentor@example.com</li>
                <li><strong>Telepon:</strong> +62 812-3456-7890</li>
                <li><strong>Alamat:</strong> Jl. Contoh No. 123, Kota, Negara</li>
                <li><strong>Deskripsi:</strong> Mentor berpengalaman dalam bidang pendidikan dan pengembangan karakter
                    siswa.</li>
            </ul>
        </div>
    </div>

    <!-- Modal Edit Profil -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" value="Nama Mentor">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="mentor@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="phone" value="+62 812-3456-7890">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address"
                                value="Jl. Contoh No. 123, Kota, Negara">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description"
                                rows="3">Mentor berpengalaman dalam bidang pendidikan dan pengembangan karakter siswa.</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn-save" data-bs-dismiss="modal" onclick="saveProfileChanges()">Simpan
                        Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Foto -->
    <div class="modal fade" id="editPhotoModal" tabindex="-1" aria-labelledby="editPhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPhotoModalLabel">Edit Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="profilePicture" class="form-label">Pilih Foto Baru</label>
                            <input class="form-control" type="file" id="profilePicture" accept="image/*"
                                onchange="previewImage(event)">
                        </div>
                        <div class="mb-3">
                            <img id="imagePreview" src="https://via.placeholder.com/120" class="img-fluid"
                                alt="Preview Foto" style="max-width: 120px; margin-top: 10px;">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn-save" data-bs-dismiss="modal" onclick="updateProfileImage()">Unggah
                        Foto</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function updateProfileImage() {
            const newImage = document.getElementById('imagePreview').src;
            document.getElementById('profileImage').src = newImage;
        }

        function saveProfileChanges() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;
            const description = document.getElementById('description').value;

            document.getElementById('profileName').textContent = name;
            console.log({ name, email, phone, address, description });
        }
    </script>
</body>

</html>
