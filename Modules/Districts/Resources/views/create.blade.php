<x-admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add District') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('app.districts.create') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col">
    <label  for="exampleInputEmail1">Name</label>
<input class="border form-control" name="name" value="{{ old('name') }}" />
</div>
                        <div class="form-group col-md-12">             
                        <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-admin>
