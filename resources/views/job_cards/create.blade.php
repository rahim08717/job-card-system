@extends('layouts.app')

@section('content')
<script src="//unpkg.com/alpinejs" defer></script>

<div class="max-w-7xl mx-auto" x-data="jobCardLogic()">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">🛠️ Create New Job Card</h2>
        <a href="{{ route('job_cards.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">
            &larr; Back to List
        </a>
    </div>

    <form action="{{ route('job_cards.store') }}" method="POST">
        @csrf

        <div class="bg-white shadow-md rounded-lg p-6 mb-6 border-l-4 border-blue-500">
            <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">1. Customer & Vehicle Details</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mobile *</label>
                    <input type="text" name="mobile" required class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Customer Name *</label>
                    <input type="text" name="name" required class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Vehicle Reg No *</label>
                    <input type="text" name="vehicle_number" required class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border uppercase" placeholder="DHAKA-GA-11-2222">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Vehicle Type</label>
                    <select name="vehicle_type" class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border bg-white">
                        @foreach($vehicleTypes as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Brand *</label>
                    <input type="text" name="brand" required class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border" placeholder="Toyota, Honda">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Model *</label>
                    <input type="text" name="model" required class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border" placeholder="Corolla, Civic">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Year</label>
                    <input type="number" name="year" class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border" placeholder="2018">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Engine No</label>
                    <input type="text" name="engine_no" class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Chassis No (Optional)</label>
                    <input type="text" name="chassis_no" class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mileage (KM)</label>
                    <input type="number" name="mileage" class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border" placeholder="50000">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fuel Type</label>
                    <select name="fuel_type" class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border bg-white">
                        @foreach($fuelTypes as $fuel)
                            <option value="{{ $fuel }}">{{ $fuel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-yellow-500">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">2. Job Card Info</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Entry Date & Time</label>
                        <input type="datetime-local" name="entry_date_time" value="{{ now()->format('Y-m-d\TH:i') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Expected Delivery</label>
                        <input type="date" name="expected_delivery_date" class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Service Advisor / Mechanic</label>
                        <input type="text" name="mechanic_name" class="mt-1 block w-full rounded border-gray-300 shadow-sm p-2 border">
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-purple-500">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">3. Customer Requests</h3>
                <div class="grid grid-cols-2 gap-2 mb-2">
                    @foreach($complaintsList as $complaint)
                    <label class="inline-flex items-center space-x-2">
                        <input type="checkbox" name="customer_complaints[]" value="{{ $complaint }}" class="rounded text-purple-600 h-4 w-4">
                        <span class="text-sm text-gray-700">{{ $complaint }}</span>
                    </label>
                    @endforeach
                </div>
                <label class="block text-xs font-bold text-gray-500 mt-3">Custom Note / Other Issues:</label>
                <textarea name="customer_complaints[]" placeholder="Write custom note here..." class="mt-1 w-full p-2 border rounded text-sm h-20"></textarea>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mb-6 border-l-4 border-red-500">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">4. Pre-Service Inspection (Checklist)</h3>

            <div class="overflow-x-auto max-h-80 overflow-y-auto border rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 relative">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 sticky top-0 z-10 shadow-sm">
                        <tr>
                            <th class="px-4 py-3 bg-gray-100">Item</th>
                            <th class="px-4 py-3 text-center bg-gray-100">Good</th>
                            <th class="px-4 py-3 text-center bg-gray-100">Bad / Repair</th>
                            <th class="px-4 py-3 text-center bg-gray-100">N/A</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($inspectionItems as $item)
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-900">{{ $item }}</td>
                            <td class="px-4 py-2 text-center">
                                <input type="radio" name="inspection_checklist[{{ $item }}]" value="Good" class="w-4 h-4 text-green-600 focus:ring-green-500" checked>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <input type="radio" name="inspection_checklist[{{ $item }}]" value="Bad" class="w-4 h-4 text-red-600 focus:ring-red-500">
                            </td>
                            <td class="px-4 py-2 text-center">
                                <input type="radio" name="inspection_checklist[{{ $item }}]" value="N/A" class="w-4 h-4 text-gray-600 focus:ring-gray-500">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mb-6 border-l-4 border-green-500">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-700">5. Services & Parts</h3>
                <button type="button" @click="addRow()" class="bg-green-600 text-white px-3 py-1 rounded text-sm font-bold shadow hover:bg-green-700 transition">
                    + Add Item
                </button>
            </div>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm text-gray-600 uppercase">
                        <th class="p-3 border">Description</th>
                        <th class="p-3 border w-32">Price</th>
                        <th class="p-3 border w-24">Qty</th>
                        <th class="p-3 border w-32">Total</th>
                        <th class="p-3 border w-10">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(row, index) in rows" :key="index">
                        <tr>
                            <td class="p-2 border"><input type="text" :name="`services[${index}][name]`" x-model="row.name" required class="w-full p-2 border rounded"></td>
                            <td class="p-2 border"><input type="number" :name="`services[${index}][price]`" x-model="row.price" @input="calculateTotal()" class="w-full p-2 border rounded text-right"></td>
                            <td class="p-2 border"><input type="number" :name="`services[${index}][quantity]`" x-model="row.qty" @input="calculateTotal()" class="w-full p-2 border rounded text-center"></td>
                            <td class="p-2 border bg-gray-50 text-right font-bold"><span x-text="formatMoney(row.price * row.qty)"></span></td>
                            <td class="p-2 border text-center"><button type="button" @click="removeRow(index)" class="text-red-500 font-bold hover:text-red-700">&times;</button></td>
                        </tr>
                    </template>
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50">
                        <td colspan="3" class="p-3 text-right font-bold">Grand Total:</td>
                        <td class="p-3 text-right font-bold text-green-600 text-xl">
                            <span x-text="formatMoney(grandTotal)"></span>
                            <input type="hidden" name="grand_total" :value="grandTotal">
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="flex justify-end pb-10">
            <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-bold shadow-lg hover:bg-blue-700 transition">Save Job Card</button>
        </div>
    </form>
</div>

<script>
    function jobCardLogic() {
        return {
            rows: [{ name: '', price: 0, qty: 1 }],
            grandTotal: 0,
            addRow() { this.rows.push({ name: '', price: 0, qty: 1 }); },
            removeRow(index) { if(this.rows.length > 1) { this.rows.splice(index, 1); this.calculateTotal(); } },
            calculateTotal() { this.grandTotal = this.rows.reduce((sum, row) => sum + (row.price * row.qty), 0); },
            formatMoney(value) { return '৳' + parseFloat(value).toFixed(2); }
        }
    }
</script>
@endsection
