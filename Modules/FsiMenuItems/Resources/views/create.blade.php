<x-admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Fsi Menu Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('app.fsi_menu_items.create') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col">
    <label  for="exampleInputEmail1">Name</label>
<input class="border form-control" name="name" value="{{ old('name') }}" />
</div>
<div class="form-group col">
    <label  for="exampleInputEmail1">Select Menu</label>
<input class="border form-control" name="fsi_menu_id" value="{{ old('fsi_menu_id') }}" />
</div>  
<div class="form-group col">
    <label  for="exampleInputEmail1">Parent Menu</label>
<input class="border form-control" name="parent_id" value="{{ old('parent_id') }}" />
</div>  
<div class="form-group col">
    <label  for="exampleInputEmail1">Icon Class</label>
<input class="border form-control" name="icon_name" value="{{ old('icon_name') }}" />
</div>  
<div class="form-group col">
    <label  for="exampleInputEmail1">Link Name</label>
<input class="border form-control" name="icon_text" value="{{ old('icon_text') }}" />
</div>  
<div class="form-group col">
    <label  for="exampleInputEmail1">Weight</label>
<input class="border form-control" name="weight" value="{{ old('weight') }}" />
</div>  
<div class="form-group col">
    <label  for="exampleInputEmail1">Has Children</label>
<input class="border form-control" name="has_children" value="{{ old('has_children') }}" />
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
