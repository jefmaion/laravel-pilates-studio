<div class="row">
    <div class="col-6">



        <div class="row">

            <div class="col-12 form-group">
                <label>Aluno</label>
                <x-form.select name="student_id" :options="$students"
                    value="{{ old('student_id', $registration->student_id ?? '') }}" />
            </div>

            <div class="col-4 form-group">
                <label>Data da Matrícula</label>
                <x-form.input type="date" name="start"
                    value="{{ date('Y-m-d', strtotime(old('start', $registration->start ?? date('Y-m-d')))) }}" />
            </div>

            <div class="col-4 form-group">
                <label>Modalidade</label>
                <x-form.select name="modality_id" :options="$modalities"
                    value="{{ old('modality_id', $registration->modality_id ?? '') }}" />
            </div>

            <div class="col-4 form-group">
                <label>Aulas por semana</label>
                <x-form.input name="class_per_week"
                    value="{{ old('class_per_week', $registration->class_per_week ?? '') }}" />
            </div>


            <div class="col-4 form-group">
                <label>Plano</label>
                <x-form.select name="duration" :options="[1 => 'Mensal', 2 => 'Bimestral', 3 => 'Trimestral']"
                    value="{{ old('duration', $registration->duration ?? '') }}" />
            </div>



            <div class="col-4 form-group">
                <label>Dia de Vencimento</label>
                <x-form.input name="due_day" value="{{ old('due_day', $registration->due_day ?? date('d')) }}" />
            </div>

            <div class="col-4 form-group">
                <label>Valor</label>
                <x-form.input name="value" value="{{ old('value', currency($registration->value) ?? '') }}" />
            </div>

            <div class="col form-group">
                <label>Observações</label>
                <x-form.textarea name="comments" rows="5">{{ old('comments', $registration->comments ?? '') }}</x-form.textarea>
            </div>


        </div>
    </div>

    <div class="col ml-4">
        <?php 
            
        $_week = [
            1 => 'Segunda-Feira',
            2 => 'Terça-Feira',
            3 => 'Quarta-Feira',
            4 => 'Quinta-Feira',
            5 => 'Sexta-Feira',
            6 => 'Sábado'
        ]    
    ?>
    
    <table class="table table-ssm table-borsdered mb-0 table-hover tasble-striped">
        <thead>
            <tr >
                <th>Dia</th>
                <th>Horario</th>
                <th>Instrutor</th>
            </tr>
        </thead>
        <tbody>
            @for($i=1;$i<=6;$i++) 
            <tr>
                <th >{{ $_week[$i] }}</th>
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
                <td>
                    <x-form.select name="class[{{ $i }}][instructor_id]" :options="$instructors"
                value="{{ old('class.'.$i.'.instructor_id', $weekclass['instructor'][$i] ?? '') }}" />
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
    </div>
</div>



{{-- <table class="table">
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
            @for($i=1;$i<=6;$i++) <td>
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
            @for($i=1;$i<=6;$i++) <td>
                <x-form.select name="class[{{ $i }}][instructor_id]" :options="$instructors"
                    value="{{ old('class.'.$i.'.instructor_id', $weekclass['instructor'][$i] ?? '') }}" />
                </td>
                @endfor
        </tr>

    </tbody>
</table> --}}


{{-- <div class="row">
    <div class="col form-group">
        <label>Observações</label>
        <x-form.textarea name="comments" value="">{{ old('comments', $registration->comments ?? '') }}</x-form.textarea>
    </div>
</div> --}}