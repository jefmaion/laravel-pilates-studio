


<div class="row">

    <div class="col-12 form-group">
        <label>Aluno</label>
        <x-form.select name="student_id" :options="$students" value="{{ old('student_id', $registration->student_id ?? '') }}" />
    </div>

    <div class="col-2 form-group">
        <label>Data da Matrícula</label>
        <x-form.input type="date" name="start" value="{{ date('Y-m-d', strtotime(old('start', $registration->start ?? date('Y-m-d')))) }}" />
    </div>

    <div class="col-2 form-group">
        <label>Modalidade</label>
        <x-form.select name="modality_id" :options="$modalities" value="{{ old('modality_id', $registration->modality_id ?? '') }}" />
    </div>

    <div class="col-2 form-group">
        <label>Aulas por semana</label>
        <x-form.input name="class_per_week" value="{{ old('class_per_week', $registration->class_per_week ?? '') }}" />
    </div>

   
    <div class="col-2 form-group">
        <label>Plano</label>
        <x-form.select name="duration" :options="[1 => 'Mensal', 2 => 'Bimestral', 3 => 'Trimestral']" value="{{ old('duration', $registration->duration ?? '') }}" />
    </div>

    

    <div class="col-2 form-group">
        <label>Dia de Vencimento</label>
        <x-form.input name="due_day" value="{{ old('due_day', $registration->due_day ?? date('d')) }}" />
    </div>

    <div class="col-2 form-group">
        <label>Valor</label>
        <x-form.input name="value" value="{{ old('value', currency($registration->value) ?? '') }}" />
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
                <x-form.select name="class[{{ $i }}][time]" :options="[
                    '07:00:00' => '07:00',
                    '08:00:00' => '08:00',
                    '09:00:00' => '09:00',
                    '10:00:00' => '10:00',
                    '11:00:00' => '11:00',
                    '12:00:00' => '12:00',
                    '13:00:00' => '13:00',
                    '14:00:00' => '14:00',
                    '15:00:00' => '15:00',
                    '16:00:00' => '16:00',
                    '17:00:00' => '17:00',
                    '18:00:00' => '18:00',
                    '19:00:00' => '19:00',
                    '20:00:00' => '20:00',
                ]" value="{{ old('class.'.$i.'.time', $weekclass['time'][$i] ?? '') }}" />
            </td>
            @endfor
        </tr>
        <tr>
            @for($i=1;$i<=6;$i++)
            <td>
                <x-form.select name="class[{{ $i }}][instructor_id]" :options="$instructors" value="{{ old('class.'.$i.'.instructor_id', $weekclass['instructor'][$i] ?? '') }}" />
            </td>
            @endfor
        </tr>
        
    </tbody>
</table>


<div class="row">
    <div class="col form-group">
        <label>Observações</label>
        <x-form.textarea name="comments" value="">{{ old('comments', $registration->comments ?? '') }}</x-form.textarea>
    </div>
</div>