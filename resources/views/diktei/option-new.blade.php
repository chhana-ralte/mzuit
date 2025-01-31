<x-diktei>
    <x-container>
        <x-block>
            <x-slot name="heading">
                Student's Details
            </x-slot>
                @csrf
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="name" value="Name" />
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="name" name="name" type="text" class="form-control" value="{{ $diktei->name }}" required disabled autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="name" value="Rollno/registration/admission no" />
                    </div>
                    
                    <div class="col-md-4">
                        <x-text-input id="rollno" name="rollno" type="text" class="form-control" value="{{ $diktei->rollno }}" required disabled autocomplete="rollno" />
                        <x-input-error class="mt-2" :messages="$errors->get('rollno')" />
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="department" value="Department" />
                    
                    </div>
                    <div class="col-md-4">
                        <x-text-input id="department" name="department" type="text" class="form-control" value="{{ $diktei->department->name }}" required disabled autocomplete="department" />
                        <x-input-error class="mt-2" :messages="$errors->get('department')" />
                    </div>
                </div>
        </x-block>
        @if($done)
            <x-block>
                <x-slot:heading>
                    Already done for the student. Preferences are:
                </x-slot:heading>
                <h2>IMJ</h2>
                    @foreach($imjoptions as $opt)
                        <div>Option {{$opt->option}}: {{$opt->dtcourse->code}}: {{$opt->dtcourse->title}}</div>
                    @endforeach
                    <h2>IMN</h2>
                    @foreach($imnoptions as $opt)
                        <div>Option {{$opt->option}}: {{$opt->dtcourse->code}}: {{$opt->dtcourse->title}}</div>
                    @endforeach
            </x-block>
        @else
            <form method="post" action="/diktei/store">
                @csrf
                <input type="hidden" name="diktei_id" value="{{ $diktei->id }}">
                <x-block>
                    <x-slot:heading>
                        Select the IMJ courses in order of your preference.
                    </x-slot:heading>
                    <div id="imj_select">
                        
                        <div class="form-group row pt-2">
                            <div class="col-md-3">
                                <x-input-label for="subject" value="{{ 'Option: ' . 1 }}" />
                            </div>
                            <div class="col-md-4">
                                <x-select name="imj[]" class="form-control imj">
                                    <option value='0'>None</option>
                                    @foreach($majors as $maj)
                                        @if($maj->intake > 0)
                                            <option value="{{ $maj->id }}">{{ $maj->code }}: {{ $maj->title }}</option>
                                        @endif
                                    @endforeach
                                </x-select>
                            </div>
                        </div>
                        
                    </div>
                </x-block>


            </form>
        @endif
    </x-container>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("select.imj").change(function(){
        //alert("Hehe");
        if($(this).val() != 0){
            $.ajax({
                url : '/diktei/imjs',
                type : 'get',
                success : function(data,status){
                    var str = `
                    <div class="form-group row pt-2">
                    <div class="col-md-3">
                        <x-input-label for="subject" value="{{ 'Option: ' . 1 }}" />
                    </div>
                    <div class="col-md-4" id="imj_select">
                    <select name="imj[]" class="form-control imj">
                    `;
                    for(i=0;i<data.length;i++){
                        str = str + "<option value='" + data[i]['id'] + " >" + data[i]['code'] + ":" + data[i]['title'] + "</option>";
                    }
                    str = str + "</select>";
                    $("#imj_select").append(str);
                    alert(str);
                },
                error : function(){
                    alert("error");
                }

            });
            
        }
    });
    $("input.form-check-input").click(function(){
        //alert($(this).attr('id'));
        $.ajax({
            url : "/ajaxtest",
            type : "post",
            data : {
                attmaster_id : $(this).attr('id')
            },
            success : function(data,status){
                //alert(data);
            },
            error : function(){
                alert("error");
            }
        })
    });
});
</script>
</x-diktei>