<div>

    <div class="flex my-4 justify-end mb-3">
        <a class="btn btn-outline" href="{{ route('transactions.index') }}" wire:navigate>Add Transaction </a>

    </div>

    <div class="relative overflow-x-auto">

        @if ($transactions->isEmpty())
            <p class="text-center text-gray-500">No transactions found</p>
        @endif

        @if ($transactions->isNotEmpty())
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
                                {{ $transaction->amount }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaction->created_at->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4 flex justify-center">
                                <button wire:click="setDeleteTransactionId({{ $transaction->id }})">
                                    <img src="{{ asset('icons/delete.svg') }}" />
                                </button>

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        @endIf



        {{ $transactions->links('vendor.pagination.tailwind') }}


        <dialog id="deleteTransactionModal" class="modal {{ $showDeleteTransactionPopup ? 'modal-open' : '' }}">
            <div class="modal-box bg-white text-black md:max-w-md">
                <h3 class="text-lg font-medium text-center">Are you sure you want to delete this transaction?</h3>


                <div class="modal-backdrop" method="POST" action="{{ route('category.store') }}">
                    @csrf


                    <button type="button" wire:click="deleteTransaction" onclick="deleteTransactionModal.close()"
                        class="btn bg-red-500 w-full mt-5 mb-3 border-none text-white">DELETE</button>
                    <button type="button" class="btn bg-white w-full text-gray-500"
                        wire:click="closeDeleteTransactionPopup">Close
                    </button>

                </div>
            </div>
        </dialog>

    </div>
</div>
