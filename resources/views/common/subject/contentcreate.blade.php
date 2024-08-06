<x-layout>
    <x-slot name="header">
    <x-button type="a" href="{{ route('syllabus.show',[$subject->syllabus->id]) }}">Back</x-button>
        {{ __('Subject') }}
    </x-slot>
    <x-container>
        <x-block>
            <x-slot name="block_header">
                {{ $subject->code }}: {{$subject->name}}
            </x-slot>
            <form method="post" action="/subject/{{ $subject->id }}/subjectcontent">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12">
                        <textarea id="editor" name="content" rows="10" placeholder="Content">
                            <p></p>
                        </textarea>
                    </div>
                </div>
                <div>
                    <x-button type="submit" >Submit</x-button>
                </div>
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
