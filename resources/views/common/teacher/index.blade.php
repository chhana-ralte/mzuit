<x-layout>
    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="/department/{{$department->id}}">Back</x-button>
                Teachers in the department of {{$department->name}}
                
            </x-slot>
            <div class="pt-2">
                <x-button type="a" href="/department/{{ $department->id }}/teacher/create">New teacher</x-button>
                @if(count($department->teachers)>0)
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
                    @foreach($department->teachers as $t)
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td><a href="/teacher/{{$t->id}}">{{ $t->person->name }}</a></td>
                        <td>{{ $t->designation }}</td>
                        @auth
                        <td>
                            <div class="btn-group">
                                <x-button type="a" href="/teacher/{{$t->id}}/edit">Edit</x-button>
                                <x-button type="delete" value="{{ $t->id }}">Delete</x-button>
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
    </x-container>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("button.btn-danger").click(function(){
        if(confirm('Are you sure you want to delete?')){
            $.ajax({
                type : 'post',
                url : '/teacher/' + $(this).val(),
                data : {
                    _method : 'delete',
                    'ajax' : 'yes'
                },
                success : function(data,status){
                    alert(data);
                    location.replace('/department/' + {{$department->id}} +'/teacher');
                },
                error : function(){
                    alert("Error");
                }
            });
        }
    });
})
</script>
</x-layout>
