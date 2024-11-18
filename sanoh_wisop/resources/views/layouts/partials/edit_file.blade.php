<script src="//unpkg.com/alpinejs" defer></script>

<div x-data="{ showEditModal: false }">
    <!-- Icon Edit untuk memicu modal -->
    <div class="flex justify-center items-center h-full">
        <a href="javascript:void(0);" @click="showEditModal = true">
            <img src="{{ asset('images/icon/icon_edit.svg') }}" alt="Edit Icon" class="w-5 h-5">
        </a>
    </div>

    <!-- Edit Modal Form -->
    <div x-show="showEditModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
        <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg" @click.away="showEditModal = false">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Edit Document</h2>
                <button @click="showEditModal = false" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>

            <!-- Form Content -->
            <form action="{{ route('documents.update', $document->doc_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Menggunakan metode PUT untuk update -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Part No. (readonly) -->
                    <div class="mb-4">
                        <label for="doc_partno" class="block text-sm font-medium">Part No.</label>
                        <input type="text" id="doc_partno" name="doc_partno" value="{{ $document->doc_partno }}"
                            class="w-full px-3 py-2 border rounded-md bg-gray-100" readonly>
                    </div>

                    <!-- Type (readonly) -->
                    <div class="mb-4">
                        <label for="doc_type" class="block text-sm font-medium">Type</label>
                        <input type="text" id="doc_type" name="doc_type" value="{{ $document->doc_type }}"
                            class="w-full px-3 py-2 border rounded-md bg-gray-100" readonly>
                    </div>

                    <!-- Doc Name (readonly) -->
                    <div class="mb-4">
                        <label for="doc_name" class="block text-sm font-medium">Doc Name</label>
                        <div class="flex items-center gap-2">
                            <input type="text" id="doc_name" name="doc_name"
                                value="{{ basename($document->doc_path) }}"
                                class="w-full px-3 py-2 border rounded-md bg-gray-100" readonly>
                            <a href="{{ asset($document->doc_path) }}" target="_blank"
                                class="text-blue-500 underline">View</a>
                        </div>
                    </div>

                    <!-- Doc Rev (readonly) -->
                    <div class="mb-4">
                        <label for="doc_rev" class="block text-sm font-medium">Doc Rev</label>
                        <input type="text" id="doc_rev" name="doc_rev" value="{{ $document->doc_rev }}"
                            class="w-full px-3 py-2 border rounded-md bg-gray-100" readonly>
                    </div>

                    <!-- Effective Date (readonly) -->
                    <div class="mb-4">
                        <label for="doc_effective_date" class="block text-sm font-medium">Effective Date</label>
                        <input type="date" id="doc_effective_date" name="doc_effective_date"
                            value="{{ \Carbon\Carbon::parse($document->doc_effective_date)->format('Y-m-d') }}"
                            class="w-full px-3 py-2 border rounded-md bg-gray-100" readonly>
                    </div>

                    <!-- Expired Date (editable) -->
                    <div class="mb-4">
                        <label for="doc_expired_date" class="block text-sm font-medium">Expired Date</label>
                        <input type="date" id="doc_expired_date" name="doc_expired_date"
                            value="{{ \Carbon\Carbon::parse($document->doc_expired_date)->format('Y-m-d') }}"
                            class="w-full px-3 py-2 border rounded-md">
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Save
                        Changes</button>
                    <button type="button" @click="showEditModal = false"
                        class="ml-2 px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
