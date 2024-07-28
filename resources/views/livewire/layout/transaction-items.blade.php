<div>

    <div class="flex justify-end my-4 mb-3">
        <a class="btn btn-outline" href="{{ route('transactions.create') }}" wire:navigate>Add Transaction </a>

    </div>

    <div class="relative overflow-x-auto">

        @if ($transactions->isEmpty())
            <p class="text-center text-gray-500">No transactions found</p>
        @endif

        @if ($transactions->isNotEmpty())


            <div x-data="{ openDeletePopup: false, deleteTransactionId: null }">
                <table class="w-full text-sm text-center text-gray-500 mb-7">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr
                                class="bg-white {{ $loop->last ? '' : 'border-b' }}  {{ $loop->even ? '!bg-gray-300' : '' }}">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $transaction->description }}
                                </th>
                                <td
                                    class="px-6 py-4 {{ $transaction->type == 'expense' ? 'text-red-500' : 'text-green-500' }}">
                                    {{ ucfirst($transaction->type) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->category->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($transaction->amount) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->transaction_date->format('d M Y') }}

                                </td>
                                <td class="flex justify-center px-6 py-4">
                                    <button
                                        x-on:click = "openDeletePopup = true; deleteTransactionId={{ $transaction->id }}">
                                        <img src="{{ asset('icons/delete.svg') }}" />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        @endIf



        {{ $transactions->links('vendor.pagination.tailwind') }}

        <div x-show='openDeletePopup'>

            <div :class="{ 'modal-open modal': openDeletePopup }">
                <div class="text-black bg-white modal-box md:max-w-md">
                    <h3 class="text-lg font-medium text-center">Are you sure you want to delete this transaction?</h3>
                    <div class="modal-backdrop">
                        @csrf
                        <button @click="$wire.call('deleteTransaction', deleteTransactionId);"
                            class="w-full mt-5 mb-3 text-white bg-red-500 border-none btn">DELETE</button>

                        <button type="button" class="w-full text-gray-500 bg-white btn"
                            @click="openDeletePopup = false">Close
                        </button>
                    </div>
                </div>
                </dialog>
            </div>
        </div>


    </div>
</div>
