@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Job Card List</h2>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($jobCards as $job)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900">
                            {{ $job->job_card_no }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                            {{ $job->vehicle->customer->name ?? 'N/A' }} <br>
                            <span class="text-xs text-gray-500">{{ $job->vehicle->customer->mobile ?? '' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                            {{ $job->vehicle->vehicle_number ?? 'N/A' }} <br>
                            <span class="text-xs text-gray-500">{{ $job->vehicle->model ?? '' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $job->status == 'Completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $job->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $job->entry_date_time->format('d M, Y h:i A') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('job_cards.show', $job->id) }}" class="text-blue-600 hover:text-blue-900"
                                    title="View Invoice">
                                    📄 View
                                </a>

                                <a href="{{ route('job_cards.edit', $job->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900" title="Edit Job">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('job_cards.destroy', $job->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this Job Card?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                        🗑 Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            No Job Cards found. Start by creating one!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
