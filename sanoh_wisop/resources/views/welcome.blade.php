<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcoming Page</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased bg-white dark:bg-slate-900 dark:text-white/50">
    <header class="flex p-4 bg-gray-800 text-white">
        <div class="ml-auto">
            <a href="/login" class="px-4 py-2 bg-blue-500 rounded hover:bg-blue-700 transition">Login</a>
        </div>
    </header>

    <!-- Main content starts here -->
    <main class="flex flex-col items-center justify-center min-h-screen">
        <h1 class="text-4xl font-bold mb-4">Welcome to PT. Sanoh Indonesia</h1>
        <form class="w-full max-w-sm" id="barcodeForm">
            <div class="mb-4">
                <input
                    id="barcodeInput"
                    class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none text-black focus:border-blue-500"
                    type="text"
                    placeholder="Scan barcode here..."
                    autofocus
                >
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const barcodeInput = document.getElementById('barcodeInput');
            const barcodeForm = document.getElementById('barcodeForm');

            // Fokuskan input ke barcode scanner ketika halaman dimuat
            barcodeInput.focus();

            // Tangani event ketika form disubmit
            barcodeForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // Ambil data dari input
                const barcodeValue = barcodeInput.value;

                // Lakukan proses yang diinginkan dengan data barcode
                if (barcodeValue) {
                    alert(`Barcode scanned: ${barcodeValue}`);
                    // Reset nilai input setelah submit
                    barcodeInput.value = '';
                    barcodeInput.focus();
                }
            });
        });
    </script>
</body>
</html>
