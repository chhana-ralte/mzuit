<x-layout>
    <x-slot:heading>
        Login page
    </x-slot:heading>

    <form method='post' action='/login'>
  @csrf
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
      <h2 class="text-base font-semibold leading-7 text-gray-900">Details</h2>
      <p class="mt-1 text-sm leading-6 text-gray-600">Enter your details.</p>
<!--      
      @if ($errors->any())
        <div class='error'>
          <ul>
            @foreach ($errors->all() as $error)
              <li> {{ $error }} </li>
            @endforeach
          </ul>
        </div>
      @endif
-->


      <x-form-field>
          <x-form-label for="email">email</x-form-label>
          <div class="mt-2">
            <x-form-input type="email" name="email" id="email" :value="old('email')" placeholder="email"/>
            <x-form-error name='email' />
          </div>
          </x-form-field>

          
      <x-form-field>
          <x-form-label for="password">Password</x-form-label>
          <div class="mt-2">
              <x-form-input type="password" name="password" id="password" placeholder="Password"/>
              <x-form-error name='password' />
          </div>
      </x-form-field>

  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
    <x-form-button>Login</x-form-button>
  </div>
</form>
</x-layout>