<ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
    <li class="media">
        <figure class="avatar mr-2 avatar-xl mr-4">
            <img src="{{ asset($class->student->user->image) }}" alt="">
        </figure>
        <div class="media-body">
            <div class="media-title smb-1">
                <a href="{{ route('registration.show', $class->registration) }}">
                    <h4>
                        {{ $class->student->user->name }}
                    </h4>
                </a>
            </div>
            <div class="h6">
                <div class="mb-2">
                    <div class="mb-1">

                        <p class="mb-1">
                            <i class="fas fa-boxes"></i>
                            {{ $class->registration->modality->name }} <span
                                class="mx-1 text-light">|</span>
                            {{ $class->registration->durationName }} ({{
                            $class->registration->class_per_week }}x) <span class="mx-1 text-light">|</span>
                            {{ $class->student->user->phone_wpp }}
                        </p>

                        <p class="mb-1">
                            <i class="fas fa-clock"></i>
                            {{ date('H', strtotime($class->time)) }}h00 <span class="mx-1 text-light">|</span>
                            {{ $class->classType }} <span class="mx-1 text-light">|</span>
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            {{ $class->instructor->user->name }}

                            {{-- @if($class->parent)
                            ( <a href="javascript:showClass({{$class->parent->id}})">{{ date('d/m/Y',
                                strtotime($class->parent->date)) }}</a> )
                            @endif --}}

                        </p>


                        

       
                        <p>
                            {!! $class->classStatusBadge !!}

                            @if($class->has_replacement)
                                <a href="javascript:showClass({{$class->parent->id}})">
                                    <x-badge theme="info" class="badge-shadow">
                                        <i class="fas fa-sync-alt    "></i>
                                        <strong>
                                            Nova Aula em {{ date('d/m/Y', strtotime($class->parent->date)) }}
                                        </strong>
                                    </x-badge>
                                </a>
                            @endif

                            @if($class->type == 'RP' && $class->parent)
                                <a href="javascript:showClass({{$class->parent->id}})">
                                    <x-badge theme="info" class="badge-shadow">
                                        <i class="fas fa-sync-alt    "></i>
                                        <strong>Reposição do dia {{ date('d/m/y', strtotime($class->parent->date)) }}</strong>
                                    </x-badge>
                                </a>
                            @endif


                            

                            @if($class->pendencies)
                            
                                @foreach($class->pendencies as $pendency)
                                <x-badge theme="warning" class="badge-shadow tet-dark">
                                    <i class="fa fa-exclamation-circle text-dansger" aria-hidden="true"></i>
                                    <strong>{{ $pendency }}</strong>
                                </x-badge>
                                @endforeach
                            
                            @endif

                        </p>


                        {{-- <p>

                            <x-badge theme="info">
                                <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                OOpa
                            </x-badge>
                            <x-badge theme="warning">Mensalidade em Atraso</x-badge>
                            <x-badge theme="danger">Mensalidade em Atraso</x-badge>

                        </p> --}}
                    </div>
                </div>
            </div>
        </div>
       
    </li>
</ul>   