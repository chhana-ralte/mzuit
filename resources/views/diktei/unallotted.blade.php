<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                List
            </x-slot>
            <div>

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link">Dept</a>
                    </li>
                    @foreach(App\Models\Department::orderBy('name')->get() as $dept)
                        @if($dept->slot())
                            <li class="nav-item">
                                <a class="nav-link" href="/diktei/unallotted?dept_id={{$dept->id}}">{{ $dept->code }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <table class="table table-striped">
                <tr>
                    <td>Sl</td>
                    <td>Name</td>
                    <td>Rollno</td>
                    <td>Department</td>
                    <td>Options</td>
                    <td>Allotted?</td>
                </tr>
                <?php 
                    if(isset($_GET['page'])){
                        $sl = ($_GET['page'] - 1)*15 + 1;
                    }
                    else{
                        $sl =1 ;
                    }
                ?>
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
                    <td>
                        {{ $dik->allotted()?$dik->allotted()->department->name:'None' }}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5">{{ $dikteis->links() }}</td>
                </tr>
            </table>
        </x-block>
    </x-container>
</x-diktei>