<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table</title>
</head>

<body>
    <!-- Table -->
    <div class="flex flex-col mt-5">
        <div class="relative overflow-x-auto shadow-md rounded-lg border border-gray-300">
            <!-- layouts/partials/table.blade.php -->
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
                        <th scope="col" class="px-2 py-3 text-center border-b border-gray-400">Process</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $document)
                        <tr>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_partno }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_type }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_path }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_rev }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">
                                {{ \Carbon\Carbon::parse($document->doc_effective_date)->format('Y-m-d') }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">
                                {{ \Carbon\Carbon::parse($document->doc_expired_date)->format('Y-m-d') }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_status }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_customer }}
                            </td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_dept }}</td>
                            <td class="px-2 py-3 text-center border-b border-gray-300">{{ $document->doc_process }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>