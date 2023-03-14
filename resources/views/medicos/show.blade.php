<x-app-layout>
    <x-slot name="header">
        <nav class="font-semibold text-xl text-gray-800 leading-tight" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
              {{-- <li class="flex items-center">
                <a href="#">Home</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
              </li> --}}
              <li class="flex items-center">
                <a href="{{ route('medicos.index') }}">{{__('Médicos')}}</a>
                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
              </li>
              <li>
                <a href="#" class="text-gray-500" aria-current="page">{{__('Editar')}} {{$medico->user->name}}</a>
              </li>
            </ol>
          </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="font-semibold text-lg px-6 py-4 bg-white border-b border-gray-200">
                    {{__('Información del médico')}}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <div>
                                <x-label for="name" :value="__('Nombre')" />

                                <x-input id="name" readonly disabled class="block mt-1 w-full" type="text" name="name" :value="$medico->user->name" required autofocus />
                            </div>

                            <div>
                                <x-label for="dni" :value="__('Dni')" />

                                <x-input id="dni" readonly disabled class="block mt-1 w-full" type="text" name="dni" :value="$medico->user->dni" required autofocus />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" readonly disabled class="block mt-1 w-full" type="email" name="email" :value="$medico->user->email" required />
                            </div>

                            {{-- <!-- Password -->
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
                            </div> --}}

                            <div>
                                <x-label for="telefono" :value="__('Telefono')" />

                                <x-input id="telefono" readonly disabled class="block mt-1 w-full" type="text" name="telefono" :value="$medico->telefono" required autofocus />
                            </div>

                            <div class="mt-4">
                                <x-label for="fecha_nacimiento" :value="__('Fecha nacimiento')" />

                                <x-input readonly disabled id="fecha_nacimiento" class="block mt-1 w-full"
                                                type="date"
                                                name="fecha_nacimiento"
                                                :value="$medico->fecha_nacimiento->format('Y-m-d')"
                                                required />
                            </div>

                            <div class="mt-4">
                                <x-label for="fecha_contratacion" :value="__('Fecha contratación')" />

                                <x-input readonly disabled id="fecha_contratacion" class="block mt-1 w-full"
                                                type="date"
                                                name="fecha_contratacion"
                                                :value="$medico->fecha_contratacion->format('Y-m-d')"
                                                required />
                            </div>

                            <div class="mt-4">
                                <x-label for="vacunado" :value="__('Vacunado')" />


                                <x-select readonly disabled id="vacunado" name="vacunado" required>
                                    <option value="">{{__('Elige una opción')}}</option>
                                    <option value="1" @if ($medico->vacunado) selected @endif>{{__('Sí')}}</option>
                                    <option value="0" @if (!$medico->vacunado) selected @endif>{{__('No')}}</option>
                                </x-select>
                            </div>

                            <div class="mt-4">
                                <x-label for="sueldo" :value="__('Sueldo')" />

                                <x-input readonly disabled id="sueldo" class="block mt-1 w-full" min="0" step="1" type="number" name="sueldo" :value="$medico->sueldo" required />
                            </div>

                            <div class="mt-4">
                                <x-label for="especialidad_id" :value="__('Especialidad')" />


                                <x-select readonly disabled id="especialidad_id" name="especialidad_id" required>
                                    <option value="">{{__('Elige una opción')}}</option>
                                    @foreach ($especialidads as $especialidad)
                                    <option value="{{$especialidad->id}}" @if ($medico->especialidad_id == $especialidad->id) selected @endif>{{$especialidad->nombre}}</option>
                                    @endforeach
                                </x-select>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button type="button" class="bg-red-800 hover:bg-red-700">
                                    <a href={{route('medicos.index')}}>
                                    {{ __('Volver al listado') }}
                                    </a>
                                </x-button>
                            </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
