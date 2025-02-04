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
                        <x-input-label for="name" value="Rollno" />
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
            <form name="submit_form" method="post" action="/diktei/option_store">
                @csrf
                <input type="hidden" name="diktei_id" value="{{ $diktei->id }}">
                <x-block>
                    <x-slot:heading>
                        Select the IMJ courses in order of your preference.
                    </x-slot:heading>
                    <div>
                        @for($i=1;$i<=10;$i++)
                        <div class="form-group row pt-2" id="imjrow_{{ $i-1 }}">
                            <div class="col-md-3">
                                <x-input-label for="subject" value="{{ 'Option: ' . $i }}" />
                            </div>
                            <div class="col-md-4">
                                <x-select name="imj[{{ $i-1 }}]" class="form-control imj">
                                    <option value='0' selected>None</option>
                                    @if($i == 1)
                                        
                                        @foreach($majors as $maj)
                                            @if($maj->intake > 0)
                                                <option value="{{ $maj->id }}" {{ isset(old('imj')[$i-1]) && old('imj')[$i-1]>0 && old('imj')[$i-1] == $maj->id?' selected ':'' }}>
                                                {{ $maj->code }}: {{ $maj->title }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif
                                </x-select>
                            </div>
                        </div>
                        @endfor
                    </div>
                </x-block>

                <x-block>
                    <x-slot:heading>
                        Select the IMN courses in order of your preference.
                    </x-slot:heading>
                    <div>
                        @for($i=1;$i<=10;$i++)
                        <div class="form-group row pt-2" id="imnrow_{{ $i-1 }}">
                            <div class="col-md-3">
                                <x-input-label for="subject" value="{{ 'Option: ' . $i }}" />
                            </div>
                            <div class="col-md-4">
                                <x-select name="imn[{{ $i-1 }}]" class="form-control imn">
                                    <option value='0' selected>None</option>
                                    @if($i == 1)
                                        
                                        @foreach($minors as $min)
                                            @if($min->intake > 0)
                                                <option value="{{ $min->id }}" {{ isset(old('imn')[$i-1]) && old('imn')[$i-1]>0 && old('imn')[$i-1] == $min->id?' selected ':'' }}>
                                                {{ $min->code }}: {{ $min->title }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif
                                </x-select>
                            </div>
                        </div>
                        @endfor
                        <div class="form-group row pt-2">
                            <div class="col-md-3">
                            
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary ok">Submit</button>
                            </div>
                        </div>
                    </div>
                </x-block>
            </form>
        @endif
    </x-container>
<script>
$(document).ready(function(){
    for(i=1;i<10;i++){
        $("#imjrow_" + i).hide();
        $("#imnrow_" + i).hide();
    }
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf_token"]').attr("content")
        }
    });

    $("button.ok").click(function(){
        var flag = 0;
        for(i=0;i<10;i++){
            if($("select.imj[name='imj[" + i + "]'").val() == 0){
                flag = 1;
                break;
            }
        }
        if(flag){
            alert("Select all 10 IMJ courses");
            exit();
        }
        flag = 0;
        for(i=0;i<10;i++){
            if($("select.imn[name='imn[" + i + "]'").val() == 0){
                flag = 1;
                break;
            }
        }
        if(flag){
            alert("Select all 10 IMN courses");
            exit();
        }

        if(confirm("Are you sure you want to submit?")){
            $("form[name='submit_form']").submit();
        }
    })

    $("select.imj").change(function(){
        var name = $(this).attr("name");
        var id = name.substring(4,name.length-1);
        var next_id = ++id;
        var next_name = "imj[" + next_id + "]";
        if($(this).val() != "0"){
            var str = "0";
            for(i=0;i<id;i++){
                nm = "imj[" + i + "]";
                str += "," + $("select.imj[name='" + nm +"']").val();
            }
            $.ajax({
                url : "/diktei/imns?str=" + str,
                type : "GET",
                success : function(data,status){
                    s = "<option value='0'>None</option>"
                    for(i=0;i<data.length;i++){
                        s += "<option value='" + data[i].id + "'>" + data[i].code + ": " + data[i].title + "</option>";
                    }
                    $("select[name='" + next_name +"']").html(s);
                    $("#imjrow_" + next_id).show();
                    for(i=next_id+1;i<10;i++){
                        $("#imjrow_" + i).hide();
                    }                
                },
                error : function(){
                    alert("error");
                }
            });
            

        }
        else{
            for(i=next_id;i<10;i++){
                $("#imjrow_" + i).hide();
            }
        }
    });


    $("select.imn").change(function(){
        var name = $(this).attr("name");
        var id = name.substring(4,name.length-1);
        var next_id = ++id;
        var next_name = "imn[" + next_id + "]";
        if($(this).val() != "0"){
            var str = "0";
            for(i=0;i<id;i++){
                nm = "imn[" + i + "]";
                str += "," + $("select.imn[name='" + nm +"']").val();
            }
            $.ajax({
                url : "/diktei/imns?str=" + str,
                type : "GET",
                success : function(data,status){
                    s = "<option value='0'>None</option>"
                    for(i=0;i<data.length;i++){
                        s += "<option value='" + data[i].id + "'>" + data[i].code + ": " + data[i].title + "</option>";
                    }
                    $("select[name='" + next_name +"']").html(s);
                    $("#imnrow_" + next_id).show();
                    for(i=next_id+1;i<10;i++){
                        $("#imnrow_" + i).hide();
                    }                
                },
                error : function(){
                    alert("error");
                }
            });            
        }
        else{
            for(i=next_id;i<10;i++){
                $("#imnrow_" + i).hide();
            }
        }
        
        
        
    });

});
</script>
</x-diktei>