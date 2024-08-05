<x-layout>
    <x-slot name="header">
            {{ __('Department') }}
    </x-slot>

    <x-container>
        <x-block>
            <x-slot name="block_header">
                {{ __("Department Entry") }}
            </x-slot>
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
            </form>

            <form method="post" action="{{ route('school.department.store',$school->id) }}" class="mt-6 space-y-6">
                @csrf
                <input type="hidden" name="school_id" value="{{ $school->id }}">
                <x-select name="school_id">
                    @foreach(App\Models\School::orderBy('code')->get() as $sch)
                        <option value="{{ $sch->id }}" {{ $school->id==$sch->id?' selected ':''}}>{{ $sch->code }} - {{ $sch->name }}</option>
                    @endforeach
                </x-select>
                <div>
                    <x-input-label for="code" :value="__('Code')" />
                    <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" :value="old('code')" required autofocus autocomplete="code" />
                    <x-input-error class="mt-2" :messages="$errors->get('code')" />
                </div>

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Create') }}</x-primary-button>
                </div>
            </form>
        </x-block>
    </x-container>
</x-layout>
