<x-admin>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candidate Profiles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <p><a href="{{ route('app.candidate_profiles.create') }}">Add Candidate Profile</a> </p>

                    <table class="table table-striped">
                        <tr>
                            
                            <td>Action</td>
                        </tr>
                        @if(count($candidate_profiles))
                        @foreach($candidate_profiles as $candidateprofile)
                            <tr>
                                
                                <td>
                                    <a href="{{ route('app.candidate_profiles.edit', $candidateprofile->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr><td colspan="0" class="text-center">No Data Available </td></tr>
                        @endif
                    </table>

                </div>
            </div>
        </div>
    </div>

</x-admin>
