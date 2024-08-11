<x-layout>
    <x-container>
        <x-block>
            <x-slot:heading>
                Courses that are being offered
            </x-slot:heading>
            <table class="table table-striped pt-2">
                <tr>
                    <th>Sl</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Teacher</th>
                </tr>
                <?php $sl=1 ?>
                @foreach($subjects as $sj)
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $sj->code }}</td>
                    <td>{{ $sj->name }}</td>
                    <td>
                        @foreach($sj->teachers($sessn) as $t)
                            {{ $t->person->name }}<br>
                        @endforeach
                    </td>
                </tr>
                @endforeach
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