<div class="p-6 bg-white border-b border-gray-200">
    <h1 class="mt-2 text-3xl font-medium text-gray-900 text-center">
        Note Tracking Management System
    </h1>
    <h2 class="mt-4 text-xl font-medium text-gray-900 text-center">
        Welcome to <span class="font-semibold"> University of Dhaka</span>
    </h2>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
    <!-- Total Patients -->
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <a href="{{ route('patient.list') }}">
            <h2 class="text-xl font-semibold text-gray-900 mb-2">
              Total  Created Notes
            </h2>
            <div class="text-3xl font-bold text-blue-600">
               {{ !empty($myCreatedNotes)?$myCreatedNotes:'0' }}

            </div>
        </a>
    </div>

    <!-- Today's Patients -->
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-900 mb-2">
            <a href="#"> Forward Notes to me</a>
        </h2>
        <div class="text-3xl font-bold text-green-600">
            {{ !empty($forwardsNotesToMe)?$forwardsNotesToMe:'0' }}
        </div>
    </div>
</div>
