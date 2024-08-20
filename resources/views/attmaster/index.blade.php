<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                @if($subject)
                    Attendance master for {{$subject->code}}: {{$subject->name}}
                @else
                    Select the subject
                @endif
            </x-slot:heading>
            <div class="pt-2">
                <div>
                @if(count($subjects)>0)
                    @foreach($subjects as $sj)
                        <x-button type="a" href="/user/{{ auth()->user()->id }}/attmaster?subject={{$sj->id}}">{{ $sj->code }}</x-button>
                    @endforeach
                @else
                    No subject assigned to you
                @endif
                </div>
                @if($attmasters && count($attmasters)>0)
                <table class="table  table-hover">
                    <tr>
                        <th>Date</th>
                        <th>Slots</th>
                    </tr>
                    @foreach($attmasters as $am)
                    <tr id="{{ $am->id }}">
                        <td>{{ date_format(date_create($am->dt),'d-m-Y') }}</td>
                        <td>{{ $am->slots }}</td>
                    </tr>
                    @endforeach
                </table>
                @endif
                @if($subject)
                <div>
                    <x-button type="a" href="/user/{{ auth()->user()->id }}/attmaster/create?subject={{ $subject->id }}">Add attendance</x-button>
                </div>
                @endif
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
