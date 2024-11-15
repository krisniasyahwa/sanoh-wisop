<script src="//unpkg.com/alpinejs" defer></script>

<div x-data="{ showModal: false }">
    <!-- Button to trigger modal -->
    <button @click="showModal = true" class="mb-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
        Add File
    </button>

    <!-- Modal Form -->
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
        <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg" @click.away="showModal = false">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Upload Files</h2>
                <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>

            <!-- Form Content -->
            <form action="{{ route('documents.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="doc_partno" class="block text-sm font-medium">Part No.</label>
                        <input type="text" id="doc_partno" name="doc_partno" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="doc_type" class="block text-sm font-medium">Type</label>
                        <select id="doc_type" name="doc_type" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="WI">WI</option>
                            <option value="SOP">SOP</option>
                            <option value="SPIS">SPIS</option>
                            <option value="SPSS">SPSS</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="doc_name" class="block text-sm font-medium">Doc Name</label>
                        <input type="file" id="doc_name" name="doc_name" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="doc_rev" class="block text-sm font-medium">Doc Rev</label>
                        <input type="text" id="doc_rev" name="doc_rev" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="doc_effective_date" class="block text-sm font-medium">Effective Date</label>
                        <input type="date" id="doc_effective_date" name="doc_effective_date" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="doc_expired_date" class="block text-sm font-medium">Expired Date</label>
                        <input type="date" id="doc_expired_date" name="doc_expired_date" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
            
                    <div class="mb-4">
                        <label for="doc_customer" class="block text-sm font-medium">Customer</label>
                        <input type="text" id="doc_customer" name="doc_customer" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="mb-4 md:col-span-2">
                        <label for="doc_dept" class="block text-sm font-medium">Department</label>
                        <select id="doc_dept" name="doc_dept" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="brazing">Brazing</option>
                            <option value="chassis">Chassis</option>
                            <option value="nylon">Nylon</option>
                            <option value="warehouse">Warehouse</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Upload</button>
                    <button type="button" @click="showModal = false" class="ml-2 px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
