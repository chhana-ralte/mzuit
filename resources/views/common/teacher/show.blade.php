<x-layout>
    <x-container>
            
        <x-block class="col-md-4">
            <x-slot name="heading">
                <x-button type="a" href="{{ route('department.teacher.index',$teacher->department->id) }}">Back</x-button>
                Personal Details
                <x-button type="a" href="{{ route('teacher.edit',$teacher->id) }}">Edit</x-button>
            </x-slot>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <td>{{ $teacher->person->name }}</td>
                        </tr>
                        <tr>
                            <th>Father</th>
                            <td>{{ $teacher->person->father }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                @foreach($teacher->person->emails as $e)
                                    {{ $e->email }}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>
                                @foreach($teacher->person->phones as $ph)
                                    {{ $ph->phone }}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>
                                @foreach($teacher->person->addresses as $ad)
                                    {{ $ad->address }}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Teacher ID</th>
                            <td>{{ $teacher->idcard }}</td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>{{ $teacher->designation }}</td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>{{ $teacher->department->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </x-block>
        
    </x-container>
</x-layout>
