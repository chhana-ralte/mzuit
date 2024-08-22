<x-layout>
    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="/department/{{$department->id}}">Back</x-button>
                Teachers in the department of {{$department->name}}
                
            </x-slot>
            <div class="pt-2">
                <x-button type="a" href="/department/{{ $department->id }}/teacher/create">New teacher</x-button>
                @if(count($teachers)>0)
                <table class="table table-striped">
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Designation</th>
                        @auth
                        <th>Manage</th>
                        @endauth
                    </tr>
                    <?php $sl=1 ?>
                    @foreach($teachers as $t)
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td><a href="/teacher/{{$t->id}}">{{ $t->person->name }}</a></td>
                        <td>{{ $t->designation }}</td>
                        @auth
                        <td>
                            <div class="btn-group">
                                <x-button type="a" href="/teacher/{{$t->id}}/edit">Edit</x-button>
                                <x-button type="delete" value="{{ $t->id }}">Hide</x-button>
                            </div>
                        </td>
                        @endauth
                    </tr>
                    @endforeach
                </table>
                @else
                No teacher in the department
                @endif
            </div>
        </x-block>
        @if(count($hiddenteachers)>0)
        <x-block>
            <x-slot:heading>
                Hidden teachers
            </x-slot-heading>
            <div class="pt-2">
                <table class="table table-striped">
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Designation</th>
                        @auth
                        <th>Manage</th>
                        @endauth
                    </tr>
                    <?php $sl=1 ?>
                    @foreach($hiddenteachers as $ht)
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td><a href="/teacher/{{$ht->id}}">{{ $ht->person->name }}</a></td>
                        <td>{{ $ht->designation }}</td>
                        @auth
                        <td>
                            <div class="btn-group">
                                <x-button type="a" href="/teacher/{{$ht->id}}/edit">Edit</x-button>
                                <x-button type="button" class="btn-unhide" value="{{ $ht->id }}">Unhide</x-button>
                            </div>
                        </td>
                        @endauth
                    </tr>
                    @endforeach
                </table>
            </div>
        </x-block>
        @endif
    </x-container>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("button.btn-danger").click(function(){
        //if(confirm('Are you sure you want to hide?')){
            $.ajax({
                type : 'post',
                url : '/teacher/' + $(this).val(),
                data : {
                    _method : 'delete',
                    'ajax' : 'yes',
                    'type' : 'hide'
                },
                success : function(data,status){
                    //alert(data);
                    location.replace('/department/' + {{$department->id}} +'/teacher');
                },
                error : function(){
                    alert("Error");
                }
            });
        //}
    });
    $("button.btn-unhide").click(function(){
        $.ajax({
            type : 'post',
            url : '/teacher/' + $(this).val(),
            data : {
                _method : 'delete',
                'ajax' : 'yes',
                'type' : 'unhide'
            },
            success : function(data,status){
                //alert(data);
                location.replace('/department/' + {{$department->id}} +'/teacher');
            },
            error : function(){
                alert("Error");
            }
        });
    });
})
</script>
</x-layout>
