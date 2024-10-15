@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Scan Barcode</h1>
    <div class="form-group">
        <label for="barcodeInput">Scan Barcode:</label>
        <input type="text" id="barcodeInput" class="form-control" autofocus>
    </div>

    <div id="scanResult" class="mt-4">
        <!-- Hasil scan akan ditampilkan di sini -->
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // QuaggaJS initialization for barcode scanning
        Quagga.init({
            inputStream: {
                type : "LiveStream",
                constraints: {
                    width: 640,
                    height: 480,
                    facingMode: "environment" // Use rear camera
                },
                target: document.querySelector('#barcodeInput')    // Or '#yourElement' (optional)
            },
            decoder: {
                readers: ["code_128_reader", "ean_reader", "ean_8_reader", "code_39_reader"] // Supported barcode types
            },
        }, function (err) {
            if (err) {
                console.log(err);
                return;
            }
            console.log("Initialization finished. Ready to start");
            Quagga.start();
        });

        Quagga.onDetected(function (data) {
            let barcode = data.codeResult.code;
            document.getElementById('barcodeInput').value = barcode;
            // Submit the scanned barcode to the backend for validation
            fetch("{{ route('warehouse.show') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ doc_partno: barcode })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('scanResult').innerHTML = "<h3>Data ditemukan</h3><p>Part Number: " + data.document.doc_partno + "</p>";
                } else {
                    document.getElementById('scanResult').innerHTML = "<h3>Data tidak ditemukan</h3>";
                }
            })
            .catch(err => {
                console.error('Error:', err);
            });
        });
    });
</script>
@endsection
