<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                Interdisciplinary Course Details for {{ $dtcourse->code }}
            </x-slot>
            <table class="table table-striped">
                
                    <tr>
                        <th>Department</th>
                        <th>{{ $dtcourse->department->name }}</th>
                    </tr>
                    <tr>
                        <th>Course code</th>
                        <th>{{ $dtcourse->code }}</th>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <th>{{ $dtcourse->title }}</th>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <th>{{ $dtcourse->type() }}</th>
                    </tr>
                    <tr>
                        <th>Total seat</th>
                        <th>{{ $dtcourse->intake }}</th>
                    </tr>
                    <tr>
                        <th>Filled</th>
                        <th>{{ $dtcourse->type() }}</th>
                    </tr>
                    <tr>
                        <th>Available</th>
                        <th>{{ $dtcourse->type() }}</th>
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