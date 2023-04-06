


<div class="row">

    <div class="col-2 form-group">
        <label>Data da Matrícula</label>
        <x-form.input type="date" name="start" value="{{ old('start', $registration->start ?? '') }}" />
    </div>

    <div class="col-2 form-group">
        <label>Modalidade</label>
        <x-form.select name="modality_id" :options="$modalities" value="{{ old('modality_id', $registration->modality_id ?? '') }}" />
    </div>

    <div class="col-8 form-group">
        <label>Aluno</label>
        <x-form.select name="student_id" :options="$students" value="{{ old('student_id', $registration->student_id ?? '') }}" />
    </div>

   

    

    <div class="col-2 form-group">
        <label>Período</label>
        <x-form.select name="duration" :options="[1 => 'Mensal', 2 => 'Bimestral', 3 => 'Trimestral']" value="{{ old('duration', $registration->duration ?? '') }}" />
    </div>

    <div class="col-2 form-group">
        <label>Aulas por semana</label>
        <x-form.input name="class_per_week" value="{{ old('class_per_week', $registration->class_per_week ?? '') }}" />
    </div>

    <div class="col-1 form-group">
        <label>Vencto</label>
        <x-form.input name="due_day" value="{{ old('due_day', $registration->due_day ?? '') }}" />
    </div>

    <div class="col-3 form-group">
        <label>Valor</label>
        <x-form.input name="value" value="{{ old('value', $registration->value ?? '') }}" />
    </div>


    
</div>

<h5>Horários de Aulas</h5>
<table class="table">
    <thead>
        <tr class="text-center">
            <th>Segunda-Feira</th>
            <th>Terça-Feira</th>
            <th>Quarta-Feira</th>
            <th>Quinta-Feira</th>
            <th>Sexta-Feira</th>
            <th>Sábado</th>
        </tr>
    </thead>
    <tbody>
        
        <tr>
            @for($i=1;$i<=6;$i++)
            <td>
                <input type="hidden" name="class[{{ $i }}][weekday]" value="{{ $i }}">
                <x-form.input type="time" name="class[{{ $i }}][time]" value="" />
            </td>
            @endfor
        </tr>

        <tr>
            @for($i=1;$i<=6;$i++)
            <td>
                <x-form.select name="class[{{ $i }}][instructor_id]" :options="$instructors" value="" />
            </td>
            @endfor
        </tr>
        
        
    </tbody>
</table>
