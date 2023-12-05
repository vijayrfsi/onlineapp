<x-admin>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Makes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <p><a href="{{ route('app.makes.create') }}">Add Make</a> </p>

                    <table class="table table-striped">
                        <tr>
                            <td>Name</td>
                            <td>Action</td>
                        </tr>
                        @if(count($makes))
                        @foreach($makes as $make)
                            <tr>
                                <td>{{ $make->name }}</td>
                                <td>
                                    <a href="{{ route('app.makes.edit', $make->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr><td colspan="1" class="text-center">No Data Available </td></tr>
                        @endif
                    </table>

                </div>
            </div>
        </div>
    </div>

</x-admin>
