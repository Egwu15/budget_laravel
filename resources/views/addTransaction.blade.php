<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Transactions') }}
        </h2>
    </x-slot>


    <div class="py-12">
        @if (session('success'))
            <x-success-message>
                {{ session('success') }}
            </x-success-message>
        @endif

        @if (session('error'))
            <x-error-message>
                {{ session('error') }}
            </x-error-message>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white max-w-md rounded-md text-center mx-auto p-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end px-5">
                <button class="btn outline bg-transparent py-2.5" onclick="addCategoryModal.showModal()">
                    Add Category
                </button>
                <dialog id="addCategoryModal" class="modal">
                    <div class="modal-box bg-white text-black md:max-w-md">
                        <h1 class="text-lg font-medium">Add Category</h1>


                        <form class="modal-backdrop" method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-500">
                                Category Name
                            </label>
                            <input type="text" name="category" id="category"
                                class="shadow-sm bg-gray-50
                                border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500
                                focus:border-blue-500 block w-full p-2.5"
                                required />
                            <button type="submit" class="btn bg-white w-full mt-5 mb-3 text-gray-500">Submit</button>
                            <button type="button" class="btn bg-white w-full text-gray-500"
                                onclick="addCategoryModal.close()">Close
                            </button>

                        </form>
                    </div>
                    <form method="dialog" class="modal-backdrop">
                        <button>close</button>
                    </form>
                </dialog>
            </div>


            <form class="max-w-sm mx-auto" method="POST" action="{{ route('transactions.store') }}">

                @csrf
                <div class="mb-5">
                    <label for="amount" class="block mb-2 text-sm font-medium ">
                        Amount
                    </label>
                    <input type="text" id="amount" name="amount"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
                <div class="mb-5">
                    <label for="category" class="block mb-2 text-sm font-medium ">
                        Category
                    </label>
                    <select id="category" name="category_id"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label for="description" class="block mb-2 text-sm font-medium ">Description</label>
                    <input type="description" id="description" name="description"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>

                <div class="mb-5">
                    <label for="type" class="block mb-2 text-sm font-medium ">Transaction Type</label>
                    <select id="type" name="type"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="expense">Expense</option>
                        <option value="income">Income</option>
                    </select>
                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Add
                    Transacton</button>
            </form>

        </div>

    </div>
</x-app-layout>
