
<p>
    {{ $class->date }} {{ $class->time }}
</p>

<p>
    {{ $class->student->user->name}}
</p>

<p>
    {{ $class->instructor->user->name}}
</p>


<hr>

<div class="row">

   

    <div class="col-3 form-group">
        <label>Status</label>
        <x-form.select name="status" :options="['Agendada', 'Presença', 'Falta com Aviso', 'Falta', 'Cancelada']"  value="{{ $class->status }}" />
    </div>



    

    <div class="col-12 form-group">
        <label>Comentários</label>
        <x-form.text-area name="comments" >{{ old('description', $class->comments) }}</x-form.text-area>
    </div>


@if($class->status == 1)

    <div class="col-12 form-group">
        <label>Evolução</label>
        <x-form.text-area name="evolution" >{{ old('description', $class->evolution) }}</x-form.text-area>
    </div>
@endif

</div>


<x-slot name="footer">

    <a name="" id="" class="btn btn-light text-dark" href="{{ route('registration.show', $class->registration) }}" role="button">
        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
        Voltar
    </a>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-check-circle    "></i>
        Salvar
    </button>
</x-slot>
