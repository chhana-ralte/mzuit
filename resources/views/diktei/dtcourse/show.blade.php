<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                Interdisciplinary Course Details for {{ $dtcourse->code }}
            </x-slot>
            <table class="table table-striped">
                
                    <tr>
                        <th>Department</th>
                        <td>{{ $dtcourse->department->name }}</td>
                    </tr>
                    <tr>
                        <th>Course code</th>
                        <td>{{ $dtcourse->code }}</td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>{{ $dtcourse->title }}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>{{ $dtcourse->type() }}</td>
                    </tr>
                    <tr>
                        <th>Credit</th>
                        <td>{{ $dtcourse->credit }}</th>
                    </tr>
                    <tr>
                        <th>Total intake</th>
                        <td>{{ $dtcourse->intake }}</td>
                    </tr>
                    <tr>
                        <th>Faculty incharge</th>
                        <td>{{ $dtcourse->faculty }}</td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td>{{ $dtcourse->contact }}</td>
                    </tr>
                    <tr>
                        <th>Filled</th>
                        <td>{{ $dtcourse->filled() }}</td>
                    </tr>
                    <tr>
                        <th>Available</th>
                        <td>{{ $dtcourse->vacant() }}</td>
                    </tr>
                <tbody>
                    <tr>
                        <td colspan=2>
                            <a class="btn btn-secondary" href="/dtcourse">Back</a>
                            <x-button type="a" href="/dtcourse/{{$dtcourse->id}}/edit">Edit</x-button>
                            <x-button type="delete" class="delete" form='delete-form'>Delete</x-button>
                            <form id='delete-form' action='/dtcourse/{{ $dtcourse->id }}' method='post' onsubmit="return confirm('I delete duh tak tak em?');" class='hidden'>
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </x-block>
    </x-container>
</x-diktei>