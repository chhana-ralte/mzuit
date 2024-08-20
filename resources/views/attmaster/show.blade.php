<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                <x-button type="a" href="/user/{{ auth()->user()->id }}/attmaster?subject={{ $attmaster->subject_id }}">Back</x-button>
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
                            <th>Update</th>
                        </tr>
                        @foreach($students as $st)
                        <tr class="rowdata" value="{{ $st['id'] }}">
                            <td>{{ $st['rollno'] }}</td>
                            <td>{{ $st['name'] }}</td>
                            <td>{{ $st['status'] }}</td>
                            <td>
                                <input type="hidden" value="0" name="students[{{ $st['id'] }}]">
                                <input type="checkbox" value="1" name="students[{{ $st['id'] }}]" id="{{ $st['id'] }}" {{ $st['status']?' checked ':''}}>
                            </td>
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
