<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                List of students
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
                    </tr>
                    <?php
                        $sl = 1;
                    ?>
                    @foreach($dikteis as $dik)
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $dik->name }}</td>
                        <td>{{ $dik->rollno }}</td>
                        <td>{{ $dik->department->name }}</td>
                        
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
        location.replace('/diktei/students?dept_id=' + $(this).val());
    });
});
</script>
</x-diktei>