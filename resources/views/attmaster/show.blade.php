<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                Attendance for {{ $attmaster->subject->code }}: {{ $attmaster->subject->name }}
            </x-slot:heading>
            <div class="pt-2">
                @if(count($students)>0)
                <form method="post" action="/attmaster/{{ $attmaster->id }}">
                    @csrf
                    @method('put')
                    <table class="table table-hover">
                        <tr>
                            <th>Rollno</th>
                            <th>Name</th>
                            <th>Attendance</th>
                        </tr>
                        @foreach($students as $st)
                        <tr class="rowdata" value="{{ $st->id }}">
                            <td>{{ $st->rollno }}</td>
                            <td>{{ $st->person->name }}</td>
                            <td><input type="checkbox" value="{{ $st->id }}" name="students[]" id="{{ $st->id }}"></td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                        No data
                    @endif
                    <div>
                        <x-button type="submit">Update</x-button>
                    </div>
                </form>
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
    $("tr.rowdata").click(function(){
        var checked = $("input#"+$(this).attr('value')).is('checked');
        $("input#"+$(this).attr('value')).attr('checked',!checked);
    });
});
</script>
</x-layout>
