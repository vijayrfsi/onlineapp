<x-admin>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fsi Menu Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <p><a href="{{ route('app.fsi_menu_items.create') }}">Add Fsi Menu Item</a> </p>

                    <table class="table table-striped">
                        <tr>
                            <td>Name</td>
                            <td>Select Menu</td>                    
                            <td>Parent Menu</td>                    
                            <td>Icon Class</td>                    
                            <td>Link Name</td>                    
                            <td>Weight</td>                    
                            <td>Has Children</td>                    
                            <td>Action</td>
                        </tr>
                        @if(count($fsi_menu_items))
                        @foreach($fsi_menu_items as $fsimenuitem)
                            <tr>
                                <td>{{ $fsimenuitem->name }}</td>
                                <td>{{ $fsimenuitem->fsi_menu_id }}</td>
                                <td>{{ $fsimenuitem->parent_id }}</td>
                                <td>{{ $fsimenuitem->icon_name }}</td>
                                <td>{{ $fsimenuitem->icon_text }}</td>
                                <td>{{ $fsimenuitem->weight }}</td>
                                <td>{{ $fsimenuitem->has_children }}</td>
                                <td>
                                    <a href="{{ route('app.fsi_menu_items.edit', $fsimenuitem->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr><td colspan="7" class="text-center">No Data Available </td></tr>
                        @endif
                    </table>

                </div>
            </div>
        </div>
    </div>

</x-admin>
