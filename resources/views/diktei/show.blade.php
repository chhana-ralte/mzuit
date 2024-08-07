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
                <tr>
                    <td>name</td><td>{{ $diktei->name }}</td>
                </tr>
                <tr>
                    <td>Rollno</td><td>{{ $diktei->rollno }}</td>
                </tr>
                <tr>
                    <td>Department</td><td>{{ $diktei->department->name }}</td>
                </tr>
                <tr>
                    <td>Options</td>
                    <td>
                    @foreach($diktei->options as $opt)
                        {{ $opt->option }} - {{$opt->department->name}} <br>
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Currently allotted in</td><td>{{ $diktei->allotted()?$diktei->allotted()->department->name:'None'}}</td>
                </tr>
                <tr>
                    <td>Newly allot to..</td>
                    <td>
                        <form method="post" type="hidden" id="assign-dept" action="/diktei/{{ $diktei->id }}/assigndept">
                        <select name="newdept" class="form-control">
                        @foreach(App\Models\Department::orderBy('name')->get() as $dept)
                            @if($dept->slot())
                                <option value="{{$dept->id }}">{{ $dept->name }}</option>
                            @endif
                        @endforeach
                        </select>
                        <x-button type="submit" form="assign-dept">Assign</x-button>
                        
                            @csrf
                        </form>
                    </td>
                </tr>                
                <tr>
                    <td></td>
                    <td>
                        <x-button type="delete" form="delete-form" value='delete'>DELETE</x-button>
                        <x-button type="delete" form="clear-form" value='clear'>CLEAR OPTIONS</x-button>
                    </td>
                    <form method="post" type="hidden" id="delete-form" action="/diktei/{{$diktei->id}}" onsubmit="return confirm('Are you sure? The record will be deleted.')">
                        @csrf
                        @method('delete')
                    </form>
                    <form method="post" type="hidden" id="clear-form" action="/diktei/{{$diktei->id}}/clear" onsubmit="return confirm('Are you sure? The options will be cleared.')">
                        @csrf
                    </form>
                </tr>
            </table>
        </x-block>
    </x-container>
</x-diktei>