<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-8" style="background-color: #FDFBF7;">

    <div class="w-full max-w-md rounded-[32px] border shadow-xl px-7 py-8 md:px-9 md:py-10"
         style="background-color: #ffffff; border-color: #f1ece4; box-shadow: 0 20px 60px rgba(52, 73, 94, 0.08);">

        <!-- HEADER -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold" style="color: #34495E;">Daftar Akun</h2>
            <p class="text-sm mt-2" style="color: #7b8a97;">
                Buat akun untuk mulai menggunakan sistem
            </p>
        </div>

        <!-- ERROR -->
        @if($errors->any())
            <div class="mb-4 rounded-2xl px-4 py-3 text-sm border"
                 style="background-color: #fff1f2; color: #b91c1c; border-color: #fecdd3;">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('register.process') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold mb-2" style="color: #34495E;">
                    Nama
                </label>
                <input type="text" name="name"
                    class="w-full rounded-2xl px-4 py-3 border"
                    style="background-color:#FDFBF7; border-color:#e8e2d8;">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color: #34495E;">
                    Username
                </label>
                <input type="text" name="username"
                    class="w-full rounded-2xl px-4 py-3 border"
                    style="background-color:#FDFBF7; border-color:#e8e2d8;">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color: #34495E;">
                    Password
                </label>
                <input type="password" name="password"
                    class="w-full rounded-2xl px-4 py-3 border"
                    style="background-color:#FDFBF7; border-color:#e8e2d8;">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color: #34495E;">
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirmation"
                    class="w-full rounded-2xl px-4 py-3 border"
                    style="background-color:#FDFBF7; border-color:#e8e2d8;">
            </div>

            <button type="submit"
                class="w-full py-3.5 rounded-2xl font-semibold text-white shadow-md"
                style="background-color:#F4A261;">
                Daftar
            </button>
        </form>

        <!-- LINK LOGIN -->
        <div class="text-center text-sm mt-5" style="color:#7b8a97;">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold" style="color:#F4A261;">
                Login
            </a>
        </div>

    </div>

</body>
</html> 