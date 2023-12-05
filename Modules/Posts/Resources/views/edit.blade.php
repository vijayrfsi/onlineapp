<x-admin>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('app.posts.update', $post->id) }}" method="post">
                    @csrf
                    @method('patch')
                        <div class="row">
                            <div class="form-group col">
    <label  for="exampleInputEmail1">Full Name</label>
    <input class="border form-contorl" name="name" value="{{ old('name', $post->name) }}" />
</div>
<div class="form-group col">
    <label  for="exampleInputEmail1">Email</label>
    <input class="border form-contorl" name="email" value="{{ old('email', $post->email) }}" />
</div>  

<div class="form-group col">
    <label  for="exampleInputEmail1">Company Name</label>
    <input class="border form-contorl" name="form__company_name" value="{{ old('form__company_name', $post->form__company_name) }}" />
</div>  

<div class="form-group col">
    <label  for="exampleInputEmail1">Enter phone number</label>
    <input class="border form-contorl" name="f4c137fa44" value="{{ old('f4c137fa44', $post->f4c137fa44) }}" />
</div>  

<div class="form-group col">
    <label  for="exampleInputEmail1">Message</label>
    <input class="border form-contorl" name="form_message" value="{{ old('form_message', $post->form_message) }}" />
</div>  

<div class="form-group col">
    <label  for="exampleInputEmail1">f4c137fa46</label>
    <input class="border form-contorl" name="form_botcheck" value="{{ old('form_botcheck', $post->form_botcheck) }}" />
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
