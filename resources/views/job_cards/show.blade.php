@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg p-8 border border-gray-200" id="printArea">

    <div class="flex justify-between items-start border-b pb-6 mb-6">
        <div>
            <h1 class="text-4xl font-extrabold text-blue-700">INVOICE</h1>
            <p class="text-gray-500">Job No: <strong>{{ $jobCard->job_card_no }}</strong></p>
        </div>
        <div class="text-right">
            <h2 class="text-xl font-bold">Ragory LTD</h2>
            <p>Status: <strong>{{ $jobCard->status }}</strong></p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-8 mb-8 text-sm">
        <div>
            <h3 class="font-bold uppercase text-gray-500 mb-2">Customer</h3>
            <p class="font-bold text-lg">{{ $jobCard->vehicle->customer->name }}</p>
            <p>{{ $jobCard->vehicle->customer->mobile }}</p>
            <p>{{ $jobCard->vehicle->customer->address }}</p>
        </div>
        <div class="text-right">
            <h3 class="font-bold uppercase text-gray-500 mb-2">Vehicle Info</h3>
            <p class="font-bold text-lg">{{ $jobCard->vehicle->vehicle_number }}</p>
            <p>{{ $jobCard->vehicle->brand }} - {{ $jobCard->vehicle->model }} ({{ $jobCard->vehicle->year }})</p>
            <p>Engine: {{ $jobCard->vehicle->engine_no }} | Mileage: {{ $jobCard->vehicle->mileage }} km</p>
            <p>Fuel: {{ $jobCard->vehicle->fuel_type }}</p>
        </div>
    </div>

    <div class="mb-6 border rounded p-4 bg-gray-50">
        <h3 class="font-bold text-gray-700 mb-2">Inspection Report</h3>
        <div class="grid grid-cols-3 gap-2">
            @if($jobCard->inspection_checklist)
                @foreach($jobCard->inspection_checklist as $part => $condition)
                    <div class="flex justify-between border-b border-gray-200 py-1">
                        <span class="text-gray-600">{{ $part }}</span>
                        <span class="font-bold {{ $condition == 'Bad' ? 'text-red-600' : 'text-green-600' }}">
                            {{ $condition }}
                        </span>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <table class="min-w-full bg-white mb-8 border">
        <thead>
            <tr class="bg-gray-100 uppercase text-xs">
                <th class="py-2 px-4 text-left">Service</th>
                <th class="py-2 px-4 text-right">Price</th>
                <th class="py-2 px-4 text-center">Qty</th>
                <th class="py-2 px-4 text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobCard->services as $service)
            <tr>
                <td class="py-2 px-4">{{ $service->service_name }}</td>
                <td class="py-2 px-4 text-right">৳{{ $service->price }}</td>
                <td class="py-2 px-4 text-center">{{ $service->quantity }}</td>
                <td class="py-2 px-4 text-right font-bold">৳{{ $service->total_price }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="bg-gray-50 font-bold">
                <td colspan="3" class="py-2 px-4 text-right">Grand Total:</td>
                <td class="py-2 px-4 text-right">৳{{ $jobCard->grand_total }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="text-center no-print">
        <button onclick="window.print()" class="bg-gray-800 text-white px-4 py-2 rounded">Print</button>
        <a href="{{ route('job_cards.edit', $jobCard->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Edit</a>
    </div>
</div>
@endsection
