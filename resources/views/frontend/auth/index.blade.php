<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Kelurahan Tipulu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen bg-gray-200">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
            <div class="text-center mb-6">
                <img src="https://placehold.co/80x80/3B82F6/FFFFFF?text=KT" alt="Logo"
                    class="mx-auto mb-4 rounded-full">
                <h1 class="text-2xl font-bold text-gray-800">Dasbor Admin Kelurahan</h1>
                <p class="text-gray-500">Silakan login untuk melanjutkan</p>
            </div>

            {{-- Form akan di-handle oleh route login Laravel --}}
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                @error('username')
                    <p class="bg-red-500 py-2 px-3 text-center text-white mb-2">{{ $message }}</p>
                @enderror
                <div class="space-y-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        {{-- 'name' attribute penting untuk form submission --}}
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Username" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="*********" required>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-blue-700 transition-colors">Login</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
