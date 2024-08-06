<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                List
            </x-slot>
            <table class="table table-striped">
                <tr>
                    <td>Sl</td>
                    <td>name</td>
                    <td>Rollno</td>
                    <td>Department</td>
                    <td>Options</td>
                </tr>
                <?php $sl =1 ?>
                @foreach($dikteis as $dik)
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td><a href="/diktei/{{$dik->id}}">{{ $dik->name }}</a></td>
                    <td>{{ $dik->rollno }}</td>
                    <td>{{ $dik->department->name }}</td>
                    <td>
                        <select class="form-control">
                            @foreach($dik->options as $opt)
                                <option>{{$opt->option}} - {{$opt->department->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td>{{ $dikteis->links() }}</td>
                </tr>
            </table>
        </x-block>
    </x-container>
</x-diktei>