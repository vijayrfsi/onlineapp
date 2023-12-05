<x-admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('app.posts.create') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col">
    <label  for="exampleInputEmail1">Full Name</label>
<input class="border form-control" name="name" value="{{ old('name') }}" />
</div>
<div class="form-group col">
    <label  for="exampleInputEmail1">Email</label>
<input class="border form-control" name="email" value="{{ old('email') }}" />
</div>  
<div class="form-group col">
    <label  for="exampleInputEmail1">Company Name</label>
<input class="border form-control" name="form__company_name" value="{{ old('form__company_name') }}" />
</div>  
<div class="form-group col">
    <label  for="exampleInputEmail1">Enter phone number</label>
<input class="border form-control" name="f4c137fa44" value="{{ old('f4c137fa44') }}" />
</div>  
<div class="form-group col">
    <label  for="exampleInputEmail1">Message</label>
<input class="border form-control" name="form_message" value="{{ old('form_message') }}" />
</div>  
<div class="form-group col">
    <label  for="exampleInputEmail1">f4c137fa46</label>
<input class="border form-control" name="form_botcheck" value="{{ old('form_botcheck') }}" />
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
