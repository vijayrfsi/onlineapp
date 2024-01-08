@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fsi_table.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.fsi_tables.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    
<div class="form-group col">
<label  for="exampleInputEmail1">field_name</label>
<input class="border form-control" name="field_name" value="{{ old('field_name') }}" />
</div>  
<div class="form-group col">
<label  for="exampleInputEmail1">real_name</label>
<input class="border form-control" name="real_name" value="{{ old('real_name') }}" />
</div>  
<div class="form-group col">
<label  for="exampleInputEmail1">field_display_name</label>
<input class="border form-control" name="field_display_name" value="{{ old('field_display_name') }}" />
</div>  
<div class="form-group col">
<label  for="exampleInputEmail1">backend_display_name</label>
<input class="border form-control" name="backend_display_name" value="{{ old('backend_display_name') }}" />
</div>  
<div class="form-group col">
<label  for="exampleInputEmail1">fsi_table_id</label>
<input class="border form-control" name="fsi_table_id" value="{{ old('fsi_table_id') }}" />
</div>  
<div class="form-group col">
<label  for="exampleInputEmail1">field_type_id</label>
<input class="border form-control" name="field_type_id" value="{{ old('field_type_id') }}" />
</div>  
<div class="form-group col">
<label  for="exampleInputEmail1">field_id</label>
<input class="border form-control" name="field_id" value="{{ old('field_id') }}" />
</div>  
<div class="form-group col">
<label  for="exampleInputEmail1">weight</label>
<input class="border form-control" name="weight" value="{{ old('weight') }}" />
</div>  
 
<div class="form-group col">
<label  for="exampleInputEmail1">user_id</label>
<input class="border form-control" name="user_id" value="{{ old('user_id') }}" />
</div>  

                    <div class="form-group col-md-12">             
                    <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
        </form>


    </div>
</div>
@endsection