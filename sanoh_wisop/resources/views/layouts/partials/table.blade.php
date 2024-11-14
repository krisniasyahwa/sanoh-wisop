<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Load jQuery -->
</head>

<body>
    <!-- Table -->
    <div class="flex flex-col mt-5">
        <div class="relative overflow-x-auto shadow-md rounded-lg border border-gray-300">
            <table class="w-full text-[11px] text-left text-gray-700 dark:text-gray-700">
                <thead class="text-[14px] text-gray-700">
                    <tr>
                        <th scope="col" class="px-2 py-3 text-center border-b border-gray-400">Part No.</th>
                        <th scope="col" class="px-2 py-3 text-center border-b border-gray-400">Type</th>
                        <th scope="col" class="px-2 py-3 text-center border-b border-gray-400">Doc Name</th>
                        <th scope="col" class="px-2 py-3 text-center border-b border-gray-400">Doc Rev</th>
                        <th scope="col" class="px-2 py-3 text-center border-b border-gray-400">Effective Date</th>
                        <th scope="col" class="px-2 py-3 text-center border-b border-gray-400">Expired Date</th>
                        <th scope="col" class="px-2 py-3 text-center border-b border-gray-400">Status</th>
                        <th scope="col" class="px-2 py-3 text-center border-b border-gray-400">Customer</th>
                        <th scope="col" class="px-2 py-3 text-center border-b border-gray-400">Department</th>
                        <th scope="col" class="px-2 py-3 text-center border-b border-gray-400">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $document)
                        <tr>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_partno }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_type }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300 flex items-center justify-center">
                                <a href="{{ asset($document->doc_path) }}" target="_blank">
                                    <img src="{{ asset('images/icon/icon_pdf.svg') }}" alt="PDF Icon" class="w-6 h-6">
                                </a>

                            </td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_rev }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">
                                {{ \Carbon\Carbon::parse($document->doc_effective_date)->format('Y-m-d') }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">
                                {{ \Carbon\Carbon::parse($document->doc_expired_date)->format('Y-m-d') }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_status }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_customer }}
                            </td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_dept }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">
                                <!-- Icon Edit -->
                                <a href="{{ route('document.edit', $document->doc_id) }}">
                                    <img src="{{ asset('images/icon/icon_edit.svg') }}" alt="Edit Icon" class="w-5 h-5">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript AJAX -->
    <script>
        // Contoh kode AJAX untuk mendapatkan informasi dokumen berdasarkan barcode
        function fetchDocument(barcodeValue) {
            $.ajax({
                url: "{{ route('document.get') }}",
                method: "POST", // Gunakan POST jika Anda menambahkan CSRF token
                data: {
                    _token: "{{ csrf_token() }}", // Tambahkan CSRF token
                    doc_partno: barcodeValue
                },
                success: function(response) {
                    if (response.success) {
                        document.getElementById('documentContent').src = response.doc_path;
                        document.getElementById('barcodeModal').classList.remove('hidden');
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error occurred while fetching document information.');
                }
            });

        }
    </script>
</body>

</html>
