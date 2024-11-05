<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Sistem PKL</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Tambahkan Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <!-- Header/Navigation -->
        <nav class="w-full bg-white shadow-lg fixed top-0">
            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <div class="text-xl font-bold">
                        Sistem PKL
                    </div>
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Register</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container mx-auto px-6 pt-32 pb-12">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-gray-800 mb-4">
                    Selamat Datang di Sistem PKL
                </h1>
                <p class="text-xl text-gray-600 mb-8">
                    Platform manajemen Praktik Kerja Lapangan yang memudahkan siswa, pembimbing, mitra, dan mentor.
                </p>

                <!-- Features Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mt-12">
                    <!-- Feature 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="text-blue-600 text-4xl mb-4">👨‍🎓</div>
                        <h3 class="text-xl font-semibold mb-2">Siswa</h3>
                        <p class="text-gray-600">Kelola pengajuan dan laporan PKL dengan mudah</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="text-blue-600 text-4xl mb-4">👨‍🏫</div>
                        <h3 class="text-xl font-semibold mb-2">Pembimbing</h3>
                        <p class="text-gray-600">Monitoring dan evaluasi progress siswa</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="text-blue-600 text-4xl mb-4">🏢</div>
                        <h3 class="text-xl font-semibold mb-2">Mitra</h3>
                        <p class="text-gray-600">Kelola program PKL dan peserta magang</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="text-blue-600 text-4xl mb-4">👨‍💼</div>
                        <h3 class="text-xl font-semibold mb-2">Mentor</h3>
                        <p class="text-gray-600">Bimbingan dan evaluasi langsung di tempat PKL</p>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="mt-12">
                    <a href="{{ route('register') }}"
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-blue-700 transition duration-300">
                        Mulai Sekarang
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="w-full bg-white shadow-lg mt-auto">
            <div class="container mx-auto px-6 py-4">
                <div class="text-center text-gray-600">
                    © {{ date('Y') }} Sistem PKL. All rights reserved.
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
