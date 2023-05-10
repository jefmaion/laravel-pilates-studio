@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Modalidades de {{ $instructor->user->name }}</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Professores</x-breadcrumb-item>
    </x-slot>
</x-page-title>


<div class="row">
    <div class="col-3">
        <form action="{{ route('instructor.modality.store', $instructor) }}" method="post">
            @csrf
            <x-card title="Modalidades Disponíveis">

                <div class="row">

                    <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">

                    <div class="col-12 form-group">
                        <label>Modalidade</label>
                        <x-form.select name="modality_id" :options="$modalities" value="{{ old('modality_id') }}" />
                    </div>

                    <div class="col-12 form-group">
                        <label>Tipo de Remuneração</label>
                        <x-form.select name="remuneration_type" :options="['P' => 'Percentual de aula (%) ',  'F' => 'Valor Fixo']" value="{{ old('remuneration_type') }}" />
                    </div>

                    <div class="col form-group">
                        <label>Valor da Remuneração</label>
                        <x-form.input name="remuneration_value" value="{{ old('remuneration_value') }}" />
                    </div>

                    <div class="col-12 form-group">
                        <x-form.switch-button class="mt-4" name="calc_on_absense" value="">Calcular na "Falta sem
                            Justificativa"</x-form.switch-button>
                    </div>

                </div>

                <x-slot name="footer">
                    <a name="" id="" class="btn btn-light text-dark" href="{{ route('instructor.show', $instructor) }}"
                        role="button">
                        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                        Voltar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle    "></i>
                        Adicionar
                    </button>
                </x-slot>

            </x-card>
        </form>
    </div>

    <div class="col d-flex">
        <x-card title="Modalidades Permitidas" class="flex-fill">
            <table class="table table-striped w-100" id="table-instructor-modality">
                <thead>
                    <tr>
                        <th>Modalidade</th>
                        <th>Tipo de Remuneração</th>
                        <th class="text-center">Valor</th>
                        <th class="text-center">Calula na Falta</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instructor->modalities as $modality)
                    <tr>
                        <td scope="row">{{ $modality->name }}</td>
                        <td>{{ $modality->pivot->remuneration_type_text }}</td>
                        <td class="text-center">{{ $modality->pivot->remuneration_value_text }}</td>
                        <td class="text-center">{{ $modality->pivot->calc_on_absense_text }}</td>
                        <td>
                            <x-delete-button class="btn btn-danger" route="{{ route('instructor.modality.destroy', [$instructor->id, $modality->id]) }}">
                                <i class="fas fa-trash-alt"></i> Remover Modalidade
                            </x-delete-button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </x-card>
    </div>
</div>

@endsection

@section('scripts')
@include('template.includes.datatable')
<script src="{{ asset('js/config.js') }}"></script>
<script src="{{ asset('js/instructor.js') }}"></script>
@endsection