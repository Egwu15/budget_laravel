<div>
    <div class="flex items-center justify-between mx-5">
        <h3 class="font-[poppins] font-bold">Spend details for the month of {{date("M")}}</h3>
        <a class="btn btn-outline font-[poppins]" href="{{ route('transactions.create') }}" wire:navigate>Add Transaction </a>
    </div>
    <div class="md:grid md:grid-cols-3 gap-3">
        <div class="card bg-base-100  rounded-md  shadow-md m-5 ">
            <div class="card-body font-[poppins]">
                <div class="bg-gray-100 rounded-full h-14 w-14 flex justify-center items-center">
                    <img src="{{ asset('icons/income.svg') }}" alt="image" class="w-10 h-10  rounded-md">
                </div>
                <h3 class="text-2xl font-bold leading-none"> ₦{{$monthCredit}}</h3>
                <div class="flex justify-between items-center">
                    <p class="text-gray-500 leading-none">Total Income</p>
                    <img src="{{ asset('icons/trend_down.svg') }}" alt="">
                </div>
            </div>
        </div>
        <div class="card bg-base-100  rounded-md  shadow-md m-5 ">
            <div class="card-body font-[poppins]">
                <div class="bg-gray-100 rounded-full h-14 w-14 flex justify-center items-center">
                    <img src="{{ asset('icons/expense.svg') }}" alt="image" class="w-10 h-10  rounded-md">
                </div>
                <h3 class="text-2xl font-bold leading-none"> ₦{{$monthDebit}}</h3>
                <div class="flex justify-between items-center">
                    <p class="text-gray-500 leading-none">Total Expense</p>
                    <img src="{{ asset('icons/trend_up.svg') }}" alt="">
                </div>
            </div>
        </div>
        <div class="card bg-base-100  rounded-md  shadow-md m-5 ">
            <div class="card-body font-[poppins]">
                <div class="bg-gray-100 rounded-full h-14 w-14 flex justify-center items-center">
                    <img src="{{ asset('icons/balance.svg') }}" alt="image" class="w-10 h-10  rounded-md">
                </div>
                <h3 class="text-2xl font-bold leading-none"> ₦{{$monthBalance}}</h3>
                <div class="flex justify-between items-center">
                    <p class="text-gray-500 leading-none">Current balance</p>
                    <img src="{{ asset('icons/trend_down.svg') }}" alt="">
                </div>
            </div>
        </div>


    </div>
