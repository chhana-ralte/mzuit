<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                Beginning
            </x-slot>
            <div>
                <form id="form" method="POST" action="/diktei/begin">
                    @csrf
                    <input type="password" name="passcode" class="form-control"/>
                    <button type="button" id="begin" class="btn btn-primary btn -xl">BEGIN</button>
                </form>
            </div>
        </x-block>
    </x-container>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf_token"]').attr("content")
        }
    });

    $("button#begin").click(function(){
        
        if($("input[name='passcode']").val() == "zama"){
            
            if(confirm("Are you sure you want to begin and erase all submitted data?")){
                $("form#form").submit();
            }
        }
    });
});
</script>
</x-diktei>