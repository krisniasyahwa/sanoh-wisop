<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcoming Page</title>
    @vite('resources/css/app.css')
</head>

<body class="font-medium antialiased bg-white dark:bg-slate-900 dark:text-white/50">
    <header class="flex items-center justify-between p-4 bg-gray-300 text-white">
        <!-- Logo di sebelah kiri -->
        <div class="flex items-center">
            <img src="{{ asset('/images/logo/logo-sanoh.png') }}" alt="Logo" class="h-8 w-auto mr-4">
            <!-- Sesuaikan ukuran logo dengan `class="h-8 w-auto mr-4"` atau sesuai kebutuhan -->
        </div>

        <!-- Tombol login di sebelah kanan -->
        <div class="ml-auto">
            <a href="/login" class="px-4 py-2 text-black hover:text-blue-900">Login</a>
        </div>
    </header>


    <!-- Main content starts here -->
    <main class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-tr to-blue-950 from-blue-700">
        <h1 class="animate-typing overflow-hidden whitespace-nowrap border-r-4 border-r-white pr-5 text-5xl text-white font-bold mb-8">Please scan your barcode here!</h1>
        <form class="w-full max-w-sm" id="barcodeForm">
            <div class="mb-4">
                <input id="barcodeInput"
                    class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none text-black focus:border-blue-500"
                    type="text" placeholder="Scan barcode here..." autofocus>
            </div>
        </form>

        <!-- Modal Container -->
        <div id="barcodeModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full h-full p-0">
                <!-- Modal Body -->
                <div class="w-full h-full">
                    <iframe id="documentContent" src="" class="w-full h-full" type="application/pdf"></iframe>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('barcodeModal');
                const closeModalButton = document.getElementById('closeModalButton');
                const closeModalFooterButton = document.getElementById('closeModalFooterButton');

                // Show modal function
                function showModal() {
                    modal.classList.remove('hidden');
                }

                // Hide modal function
                function hideModal() {
                    modal.classList.add('hidden');
                }

                // Event listener for close buttons
                closeModalButton.addEventListener('click', hideModal);
                closeModalFooterButton.addEventListener('click', hideModal);

                // Optionally, listen for clicking outside the modal content to close
                window.addEventListener('click', (event) => {
                    if (event.target === modal) {
                        hideModal();
                    }
                });
            });
        </script>

    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const barcodeInput = document.getElementById('barcodeInput');
            const barcodeForm = document.getElementById('barcodeForm');
            const barcodeModal = document.getElementById('barcodeModal');
            const documentContent = document.getElementById('documentContent');
            // const pdfUrl = `/path/to/pdf/${documentValue}.pdf`;

            // Fokuskan input ke barcode scanner ketika halaman dimuat
            barcodeInput.focus();

            // Tangani event ketika form disubmit
            barcodeForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // Ambil data dari input
                const barcodeValue = barcodeInput.value;
                // const documentValue = documentInput.value;

                // Lakukan proses yang diinginkan dengan data barcode
                if (barcodeValue !== "") {
                    // alert(`Barcode scanned: ${documentValue}`);
                    // Reset nilai input setelah submit

                    // Set informasi dokumen ke dalam modal
                    // document.getElementById('documentDetails').innerText =
                    //     `Informasi dokumen: Test Document`;

                    // Lakukan AJAX request untuk mendapatkan informasi dokumen
                    $.ajax({
                        url: "{{ route('documents.get') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            doc_partno: barcodeValue
                        },
                        success: function(response) {
                            if (response.success) {
                                // Tampilkan dokumen dalam iframe
                                documentContent.src = response.doc_path;
                                barcodeModal.classList.remove('hidden');
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function() {
                            alert('Error occurred while fetching document information.');
                        }
                    });

                    // Reset nilai input setelah submit
                    barcodeInput.value = '';
                    barcodeInput.focus();
                } else {
                    alert('Please enter a barcode');
                }
            });

            // Hide modal function
            function hideModal() {
                barcodeModal.classList.add('hidden');
            }
            // Event listener for close buttons
            document.getElementById('closeModalButton').addEventListener('click', hideModal);
            document.getElementById(
                'closeModalFooterButton').addEventListener('click', hideModal);

            // Optionally, listen for clicking outside the modal content to close
            window.addEventListener('click', (event) => {
                if (event.target === barcodeModal) {
                    hideModal();
                }
            });
        });
    </script>
</body>

</html>
