<x-admin>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <p><a href="{{ route('app.posts.create') }}">Add Post</a> </p>

                    <table class="table table-striped">
                        <tr>
                            <td>Full Name</td>
                            <td>Email</td>                    
                            <td>Company Name</td>                    
                            <td>Enter phone number</td>                    
                            <td>Message</td>                    
                            <td>f4c137fa46</td>                    
                            <td>Action</td>
                        </tr>
                        @if(count($posts))
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->name }}</td>
                                <td>{{ $post->email }}</td>
                                <td>{{ $post->form__company_name }}</td>
                                <td>{{ $post->f4c137fa44 }}</td>
                                <td>{{ $post->form_message }}</td>
                                <td>{{ $post->form_botcheck }}</td>
                                <td>
                                    <a href="{{ route('app.posts.edit', $post->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr><td colspan="6" class="text-center">No Data Available </td></tr>
                        @endif
                    </table>

                </div>
            </div>
        </div>
    </div>

</x-admin>
