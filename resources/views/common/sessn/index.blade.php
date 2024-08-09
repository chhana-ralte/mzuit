<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                Sessions <x-button type="a" href="/sessn/create">New session</x-button>
            </x-slot:heading>
            <table class="table table-striped pt-2">
                <tr>
                    <th>Sl</th>
                    <th>Session</th>
                    <th>Default session</th>
                </tr>
                <?php $sl=1 ?>
                @foreach($sessns as $ses)
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $ses->name() }} </td>
                    <td><input type="radio" name="default_sessn" value="{{ $ses->id }}" {{ $ses->cur_ssn()?' checked ':''}}></td>
                </tr>
                @endforeach
                <tr>
                    <td colspan=3>{{ $sessns->links() }}</td>
                </tr>
            </table>
        </x-block>
    </x-container>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("input[name='default_sessn']").click(function(){
        //alert($(this).attr('id'));
        $.ajax({
            url : "/sessn",
            type : "post",
            data : {
                sessn_id : $(this).val(),
                type : 'default_sessn'
            },
            success : function(data,status){
                alert(data);
            },
            error : function(){
                alert("error");
            }
        })
    });
});
</script>
</x-layout>