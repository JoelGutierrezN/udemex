<div class="bg-gray-200 dark:bg-gray-700 dark:text-white min-h-screen py-32 px-10">

    <div class="text-center mb-10 md:w-3/4 lg:w-1/2 mx-auto">
        <div class="text-5xl tracking-tight leading-10 font-extrabold text-gray-900 dark:text-white">
            {{ config('app.name') }}
        </div>
    </div>

    <div class="bg-white dark:bg-gray-600 p-10 rounded-lg shadow-lg w-full lg:w-1/3 mx-auto">

        <div class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-yellow-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div>
                    <p class="font-bold">We use Microsoft 365 for accessing your account.</p>
                    <p class="text-sm">Click the button below to get started.</p>
                </div>
            </div>
        </div>

        <p><a class="mt-5 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" href="{{ route('connect') }}">Login with your Microsoft Account</a></p>

    </div>

</div>
