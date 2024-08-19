<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                Attendance master
            </x-slot:heading>
            <div class="pt-2">
                @if(count($attmasters)>0)
                <table class="table  table-hover">
                    <tr>
                        <th>Date</th>
                        <th>Subject</th>
                        <th>Slots</th>
                    </tr>
                    @foreach($attmasters as $am)
                    <tr id="{{ $am->id }}">
                        <td>{{ date_format(date_create($am->dt),'d-m-Y') }}</td>
                        <td>{{ $am->subject->code }}: {{ $am->subject->name }}</td>
                        <td>{{ $am->slots }}</td>
                    </tr>
                    @endforeach
                </table>
                @else
                    No data
                @endif
                <div>
                    <x-button type="a" href="/user/{{ auth()->user()->id }}/attmaster/create">Add attendance</x-button>
                </div>
                <button>Click me</button>
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
