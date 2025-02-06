<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                List of unallotted students 
                @if(isset($department))
                    from {{ $department->name }}
                @endif
            </x-slot>
            <div>
                <div class="form-group row pt-2">
                    <div class="col-md-4">
                        <x-select name="department" class="form-control imn">
                            <option value='0' selected>Select Department</option>
                                @foreach($departments as $dep)
                                    <option value="{{ $dep->id }}" {{ isset($department) && $department->id==$dep->id?' selected ':'' }}>
                                        {{ $dep->name }}
                                    </option>
                                @endforeach
                            
                        </x-select>
                    </div>
                </div>
            </div>
            @if(isset($department))
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
                @foreach($dtunalotted as $dik)
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

            </table>
            @endif
        </x-block>
    </x-container>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf_token"]').attr("content")
        }
    });

    $("select[name='department']").change(function(){
        //alert($(this).val());
        if($(this).val() != 0){
            location.replace('/diktei/unallotted?dept_id=' + $(this).val());
        }
    });
});
</script>
</x-diktei>