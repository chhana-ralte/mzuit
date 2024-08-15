<x-layout>
    <x-container>
        <x-block>
            <x-slot name="heading">
                <x-button type="a" href="{{ route('subject.show',[$subjectcontent->subject->id]) }}">Back</x-button>
                {{ $subjectcontent->subject->code }}: {{$subjectcontent->subject->name}}
            </x-slot>
            <form method="post" action="/subjectcontent/{{$subjectcontent->id}}">
                @csrf
                @method('PUT')
                <table class="table table-striped">
                    <tr>
                        <td>
                            <div class="form-group row pt-2">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="version" value="{{ $subjectcontent->version }}" placeholder="Version">
                                </div>
                            </div>
                            <div class="form-group row pt-2">
                                <div class="col-md-12">
                                    <textarea id="editor" name="content" rows="10" placeholder="Content">
                                    {{ $subjectcontent->content }}
                                    </textarea>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <x-button type="submit" >Update</x-button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </x-block>
    </x-container>



    <script type="importmap">
            {
                "imports": {
                    "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js",
                    "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.1/"
                }
            }
        </script>
        <script type="module">
            import {
                ClassicEditor,
                Essentials,
                Paragraph,
                Bold,
                Italic,
                Font
            } from 'ckeditor5';

            ClassicEditor
                .create( document.querySelector( '#editor' ), {
                    plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
                    toolbar: [
						'undo', 'redo', '|', 'bold', 'italic', '|',
						'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                } )
                .then( editor => {
                    window.editor = editor;
                } )
                .catch( error => {
                    console.error( error );
                } );
        </script>
        <!-- A friendly reminder to run on a server, remove this during the integration. -->
        <script>
		        window.onload = function() {
		            if ( window.location.protocol === "file:" ) {
		                alert( "This sample requires an HTTP server. Please serve this file with a web server." );
		            }
		        };
		</script>
</x-layout>
