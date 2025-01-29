<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                Search
            </x-slot>
            <div>
                <form method="get" action="/diktei/search">
                    <input class="form-control" name="search" value="{{ $str }}">
                    <x-button type="submit">Search</x-button>
                </form>
            </div>
            @if(isset($_GET['search']))
                <table class="table table-striped">
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Rollno</th>
                        <th>Department</th>
                        <th>IMJ Options</th>
                        <th>IMJ Allotted?</th>
                        <th>IMN Options</th>
                        <th>IMN Allotted?</th>
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
                                @foreach($dik->dtoptions as $opt)
                                    @if($opt->major)
                                        <option>{{$opt->option}} - {{$opt->dtcourse->code}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            {{ $dik->mjallotted()?$dik->mjallotted()->dtcourse->code:'None' }}
                        </td>
                        <td>
                            <select class="form-control">
                                @foreach($dik->dtoptions as $opt)
                                    @if($opt->major == 0)
                                        <option>{{$opt->option}} - {{$opt->dtcourse->code}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            {{ $dik->mnallotted()?$dik->mnallotted()->dtcourse->code:'None' }}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="8">{{ $dikteis->links() }}</td>
                    </tr>
                </table>
            @endif
        </x-block>
    </x-container>
</x-diktei>