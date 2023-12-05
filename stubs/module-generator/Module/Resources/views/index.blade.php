<x-admin>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('{ModuleText}') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <p><a href="{{ route('app.{module}.create') }}">Add {ModelText}</a> </p>

                    <table class="table table-striped">
                        <tr>
                            {field_headers}
                            <td>Action</td>
                        </tr>
                        @if(count(${module}))
                        @foreach(${module} as ${model})
                            <tr>
                                {field_name}
                                <td>
                                    <a href="{{ route('app.{module}.edit', ${model}->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr><td colspan="{field_count}" class="text-center">No Data Available </td></tr>
                        @endif
                    </table>

                </div>
            </div>
        </div>
    </div>

</x-admin>
