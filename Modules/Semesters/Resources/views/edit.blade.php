<x-admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Semester') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('app.semesters.update', $semester->id) }}" method="post">
                    @csrf
                    @method('patch')
                        <div class="row">
                            <div class="form-group col">
    <label  for="exampleInputEmail1">Name</label>
    <input class="border form-contorl" name="name" value="{{ old('name', $semester->name) }}" />
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
