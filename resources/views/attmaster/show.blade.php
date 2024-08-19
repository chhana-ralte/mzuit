<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                Attendance for {{ $subject->code }}: {{ $subject->name }}
            </x-slot:heading>
            <div class="pt-2">
                @if(count($attendance)>0)
                <table class="table table-hover">
                    <tr>
                        <th>Rollno</th>
                        <th>Name</th>
                        <th>Existing</th>
                        <th>Attendance</th>
                    </tr>
                    @foreach($attendance as $att)
                    <tr>
                        <td>{{ $student->rollno }}</td>
                        <td>{{ $student->person->name }}</td>
                        <td>{{  }}</td>
                        <td>{{  }}</td>
                    </tr>
                    @endforeach
                </table>
                @else
                    No data
                @endif
                <div>
                    <x-button type="submit">Update</x-button>
                </div>
            </div>
        </x-block>
    </x-container>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $("meta[name='csrf-token']").attr('content')
        }
    });
    $("tr").click(function(){
        //alert($(this).attr('id'));
        location.replace("/attmaster/" + $(this).attr('id'));
    });
});
</script>
</x-layout>
