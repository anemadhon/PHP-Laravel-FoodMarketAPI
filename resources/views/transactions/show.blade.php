<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-flex items-center">
            {{ __('Transaction') }} 
            <svg class="h-5 w-auto" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg> 
            {{ "Order Id: $transaction->id" }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    @if ($transaction->user->profile_photo_path === null)
                        <svg class="w-full h-64 rounded-full overflow-hidden bg-gray-100 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    @endif
                    @if ($transaction->user->profile_photo_path)
                        <img class="w-full h-64 rounded object-cover" src="{{ asset('storage/'.$transaction->user->profile_photo_path) }}" alt="transactions avatar" loading="lazy">
                    @endif
                    <div class="mt-2 px-4 sm:px-0 mx-10 sm:mx-0">
                        <div class="text-sm">User</div>
                        <div class="text-xl font-bold"> {{ $transaction->user->name .'(@'.$transaction->user->username.')' }} </div>
                        <div class="text-sm"> {{ $transaction->user->email }} </div>
                        <div class="text-sm"> {{ $transaction->user->phone_number }} </div>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="mb-2">
                                <div class="text-md font-bold">Orders</div>
                            </div>
                            {{-- <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                    <tr>
                                        <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Foods Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Price
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($transaction as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex items-center text-sm">
                                                    <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                                        @if ($order->food->image_path === null)
                                                            <svg class="w-full h-full rounded-full overflow-hidden bg-gray-100 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                        @endif
                                                        @if ($order->food->image_path)
                                                            <img class="object-cover w-full h-full rounded-full" src="{{ asset('storage/'.$order->food->image_path) }}" alt="foods cover" loading="lazy" />
                                                        @endif
                                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                    </div>
                                                    {{ $order->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $order->description }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ 'Rp. '.number_format($order->price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $order->type }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> --}}
                        </div>
                        <div class="flex flex-wrap">
                            <div class="px-4 py-5 w-4/6">
                                <div class="text-sm">Delivered to</div>
                                <div class="text-md font-bold">{{ $transaction->user->address }}</div>
                            </div>
                            <div class="px-4 py-5 w-1/6">
                                <div class="text-sm">Houses Number</div>
                                <div class="text-md font-bold">{{ $transaction->user->house_number }}</div>
                            </div>
                            <div class="px-4 py-5 w-1/6">
                                <div class="text-sm">City</div>
                                <div class="text-md font-bold">{{ $transaction->user->city }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <div class="px-4 py-5 w-1/6">
                            <div class="text-sm">Total to Pay</div>
                            <div class="text-md font-bold">{{ $transaction->total }}</div>
                        </div>
                        <div class="px-4 py-5 w-4/6">
                            <div class="text-sm">Payments URL</div>
                            <div class="text-md font-bold">{{ $transaction->payment_url }}</div>
                        </div>
                        <div class="px-4 py-5 w-1/6">
                            <div class="text-sm">Status</div>
                            <div class="text-md font-bold">{{ $transaction->status }}</div>
                        </div>
                    </div>
                    <p class="px-2 py-2 whitespace-nowrap">
                        <span class="text-md">Change Status : </span>
                        <a href="{{ route('transactions.changeStatus', ['id' => $transaction->id, 'status' => 'ON_DELIVERY']) }}"><span class="px-2 mb-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-600 hover:text-blue-900">On Delivery</span></a>
                        <a href="{{ route('transactions.changeStatus', ['id' => $transaction->id, 'status' => 'DELIVERED']) }}"><span class="px-2 mb-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-600 hover:text-green-900">Delivered</span></a>
                        <a href="{{ route('transactions.changeStatus', ['id' => $transaction->id, 'status' => 'CANCELLED']) }}"><span class="px-2 mb-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-600 hover:text-red-900">Cancelled</span></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
