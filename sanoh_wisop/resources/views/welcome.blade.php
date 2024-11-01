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
                <input id="barcodeInput"
                    class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none text-black focus:border-blue-500"
                    type="text" placeholder="Scan barcode here..." autofocus>
            </div>
        </form>

        <!-- Modal Container -->
        <div id="barcodeModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-10/12 lg:w-9/12 xl:w-8/12 p-6">
                <!-- Modal Header -->
                <div class="flex justify-between items-center border-b pb-3">
                    <h3 class="text-xl font-semibold">Document Information</h3>
                    <button id="closeModalButton" class="text-gray-600 hover:text-gray-900 text-3xl">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="mt-4">
                    <iframe id="documentContent" src="" class="w-full h-[700px] md:h-[600px]"
                        type="application/pdf"></iframe>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end mt-6">
                    <button id="closeModalFooterButton"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700 transition">Close</button>
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
