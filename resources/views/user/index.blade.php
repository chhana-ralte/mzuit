<x-layout>
    <x-container>
        <x-block>
            <x-slot name="heading">
                List of users
            </x-slot>
            <div class="pt-2">
                <x-button type="a" href="/user/create">New user</x-button>
                <div class="pt-2">
                @if(count($users)>0)
                
                    <table class="table table-striped pt-2">
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>email</th>
                            <th>Edit|Delete</th>
                        </tr>
                        <?php $sl=1 ?>
                        @foreach($users as $u)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td><a href="/user/{{$u->id}}">{{ $u->name }}</a></td>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <div class="btn-group">
                                    <x-button type="a" href="/user/{{$u->id}}/edit">Edit</x-button>
                                    <x-button type="delete" class="delete" value="{{$u->id}}">Delete</x-button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    No user
                    @endif
                    <form method="post" id="form-delete">
                        @csrf
                        @method('delete')
                    </form>
                </div>
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
    $("button.delete").click(function(){
        if(confirm('Are you sure you want to delete?')){
            $("form#form-delete").attr('action','/user/' + $(this).val());
            $("form#form-delete").submit();
        }
    });
})
</script>
</x-layout>
