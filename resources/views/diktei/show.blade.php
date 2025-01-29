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
            </table>
        </x-block>
        <x-block>
            <x-slot name="heading">
                IMJ details
            </x-slot>
            <table class="table table-striped">
                <tr>
                    <td>IMJ Options</td>
                    <td>
                    @foreach($diktei->imjoptions() as $opt)
                        {{ $opt->option }} - {{$opt->dtcourse->code}} <br>
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Currently allotted in</td>
                    <td>{{ $diktei->mjallotted()?$diktei->mjallotted()->dtcourse->code:'None'}}
                        @if($diktei->mjallotted())
                            {{$diktei->mjallotted()->dtcourse->code}}: {{$diktei->mjallotted()->dtcourse->title}}
                        @else
                            None
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Newly allot to..</td>
                    <td>
                        <form method="post" type="hidden" id="assign-imj" action="/diktei/{{ $diktei->id }}/assigncourse">
                            @csrf
                            <input type='hidden' name='major' value='1'>
                            <select name="dtcourse" class="form-control">
                            @foreach($majors as $mj)
                                <option value="{{$mj->id }}">{{ $mj->code }}: {{ $mj->title }}</option>
                            @endforeach
                            </select>
                            <x-button type="submit" form="assign-imj">Assign</x-button>
                        </form>
                    </td>
                </tr>      
            </table>
        </x-block>


        <x-block>
            <x-slot name="heading">
                IMN details
            </x-slot>
            <table class="table table-striped">
                <tr>
                    <td>IMN Options</td>
                    <td>
                    @foreach($diktei->imnoptions() as $opt)
                        {{ $opt->option }} - {{$opt->dtcourse->code}} <br>
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Currently allotted in</td>
                    <td>{{ $diktei->mnallotted()?$diktei->mnallotted()->dtcourse->code:'None'}}
                        @if($diktei->mnallotted())
                            {{$diktei->mnallotted()->dtcourse->code}}: {{$diktei->mnallotted()->dtcourse->title}}
                        @else
                            None
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Newly allot to..</td>
                    <td>
                        <form method="post" type="hidden" id="assign-imn" action="/diktei/{{ $diktei->id }}/assigncourse">
                            @csrf
                            <input type='hidden' name='major' value='0'>
                            <select name="dtcourse" class="form-control">
                            @foreach($minors as $mn)
                                <option value="{{$mn->id }}">{{ $mn->code }}: {{ $mn->title }}</option>
                            @endforeach
                            </select>
                            <x-button type="submit" form="assign-imn">Assign</x-button>
                        </form>
                    </td>
                </tr>      
            </table>
        </x-block>




        <x-block>
            <table class="table table-striped">
                <tr>
                    <td></td>
                    <td>
                        <x-button type="delete" form="delete-form" value='delete'>DELETE STUDENT</x-button>
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
                <tr>
                    <td colspan=2>
                        Note: When deleting, the details of student will be deleted. 
                        Whereas when clearing options, student detail is not deleted, options can be given afresh.
                    </td>
            </table>
        </x-block>
    </x-container>
</x-diktei>