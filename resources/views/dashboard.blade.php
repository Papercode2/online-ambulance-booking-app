<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ambulance Booking Panel') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-8">
        <!-- Welcome and status section -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in! Manage your ambulance bookings below.") }}
                </p>
            </div>
        </div>

        <!-- Available Ambulances Section -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('Available Ambulances') }}</h3>
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Plate Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <!-- Loop through available ambulances -->
                            @forelse ($ambulances as $ambulance)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $ambulance->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $ambulance->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $ambulance->plate_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $ambulance->status == 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($ambulance->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
                                        {{ __('No ambulances available.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Booking Form Section -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('Book an Ambulance') }}</h3>
                <form method="POST" action="{{ route('bookings.store') }}">
                    @csrf
                    <!-- Select Ambulance -->
                    <div class="mb-4">
                        <label for="ambulance_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Select Ambulance') }}</label>
                        <select id="ambulance_id" name="ambulance_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                            <option value="">{{ __('Choose an ambulance') }}</option>
                            @foreach ($ambulances as $ambulance)
                                @if($ambulance->status === 'available')
                                    <option value="{{ $ambulance->id }}">{{ $ambulance->name }} - {{ $ambulance->plate_number }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Pickup Location -->
                    <div class="mb-4">
                        <label for="pickup_location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Pickup Location') }}</label>
                        <input type="text" id="pickup_location" name="pickup_location" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100" placeholder="Enter pickup location" required>
                    </div>

                    <!-- Drop-off Location -->
                    <div class="mb-4">
                        <label for="dropoff_location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Drop-off Location') }}</label>
                        <input type="text" id="dropoff_location" name="dropoff_location" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100" placeholder="Enter drop-off location" required>
                    </div>

                    <!-- Booking Date & Time -->
                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="booking_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Booking Date') }}</label>
                            <input type="date" id="booking_date" name="booking_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100" required>
                        </div>
                        <div>
                            <label for="booking_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Booking Time') }}</label>
                            <input type="time" id="booking_time" name="booking_time" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400">
                            {{ __('Book Now') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
