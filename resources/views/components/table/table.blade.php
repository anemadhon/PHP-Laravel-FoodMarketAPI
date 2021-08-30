<table class="min-w-full divide-y divide-gray-200 w-full">
    <thead>
        <tr>
            @foreach ($headers as $th)
                <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ $th }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        {{ $slot }}
    </tbody>
</table>