<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                Student's details
            </x-slot>
            <table class="table table-striped">
                <tr>
                    <td>ID</td><td>{{ $diktei->id }}</td>
                    </tr>
                    <td>name</td><td>{{ $diktei->name }}</td>
                    </tr>
                    <td>Rollno</td><td>{{ $diktei->rollno }}</td>
                    </tr>
                    <td>Department</td><td>{{ $diktei->department->name }}</td>
                    </tr>
                    <td>Options</td>
                    <td>
                    @foreach($diktei->options as $opt)
                        {{ $opt->option }} - {{$opt->department->name}} <br>
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><x-button type="delete" form="delete-form">DELETE</x-button></td>
                    <form method="post" type="hidden" id="delete-form" action="/diktei/{{$diktei->id}}" onsubmit="return confirm('Are you sure? The record will be deleted.')">
                        @csrf
                        @method('delete')
                    </form>
                </tr>
            </table>
        </x-block>
    </x-container>
</x-diktei>