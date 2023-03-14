<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
                <input type="hidden" value="1" name="tipo_usuario_id">
            @csrf
            <div>
                <x-label for="name" :value="__('Nombre')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Dni -->
            <div class="mt-4">
                <x-label for="dni" :value="__('Dni')" />

                <x-input id="dni" class="block mt-1 w-full" type="text" name="dni" :value="old('dni')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Contraseña')" />

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <x-label for="telefono" :value="__('Telefono')" />

                <x-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="fecha_nacimiento" :value="__('Fecha nacimiento')" />

                <x-input id="fecha_nacimiento" class="block mt-1 w-full"
                         type="date"
                         name="fecha_nacimiento"
                         :value="old('fecha_nacimiento')"
                         required />
            </div>

            <div class="mt-4">
                <x-label for="fecha_contratacion" :value="__('Fecha contratación')" />

                <x-input id="fecha_contratacion" class="block mt-1 w-full"
                         type="date"
                         name="fecha_contratacion"
                         :value="old('fecha_contratacion')"
                         required />
            </div>

            <div class="mt-4">
                <x-label for="vacunado" :value="__('Vacunado')" />


                <x-select id="vacunado" name="vacunado" required>
                    <option value="">{{__('Elige una opción')}}</option>
                    <option value="1" @if (old('vacunado') == 1) selected @endif>{{__('Sí')}}</option>
                    <option value="0" @if (old('vacunado') == 0) selected @endif>{{__('No')}}</option>
                </x-select>
            </div>

            <div class="mt-4">
                <x-label for="sueldo" :value="__('Sueldo')" />

                <x-input id="sueldo" class="block mt-1 w-full" min="0" step="1" type="number" name="sueldo" :value="old('sueldo')" required />
            </div>

            <div class="mt-4">
                <x-label for="especialidad_id" :value="__('Especialidad')" />


                <x-select id="especialidad_id" name="especialidad_id" required>
                    <option value="">{{__('Elige una opción')}}</option>
                    @foreach ($especialidads as $especialidad)
                        <option value="{{$especialidad->id}}" @if (old('especialidad_id') == $especialidad->id) selected @endif>{{$especialidad->nombre}}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
