<x-layout>
    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="/user">Back</x-button>
                Create user
            </x-slot>
            <form method="post" action="/user/" class="pt-2">
                @csrf
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <label for="name">Name</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <label for="username">Username</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="username" required>
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-md-4">
                        <input type="email" class="form-control" name="email" required>
                    </div>
                </div>

                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        Roles
                    </div>
                    <div class="col-md-4">
                        @foreach(\App\Models\Role::all() as $rl)
                            <input type="checkbox" id="{{ $rl->id }}" name="roles[]" value="{{ $rl->id }}">
                            <label for="{{ $rl->id }}">{{ $rl->role}}</label><br>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-4">
                        <x-button type="a" href="/user">Back</x-button>
                        <x-button type="submit">Submit</x-button>
                    </div>
                </div>
            </form>
        </x-block>
    </x-container>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("button.btn-delete").click(function(){
        if(confirm('Are you sure you want to delete?')){
            
        }
    });
})
</script>
</x-layout>
