<x-card style="primary" title="Dados da Matrícula">
    <div class="row">
        <div class="col-12">
            <div class="row">

                @if(!empty($registration->id))
                <input type="hidden" name="class_per_week" value="{{ $registration->class_per_week }}">
                @endif

                <div class="col-2 form-group">
                    <label>Data da Matrícula</label>
                    <x-form.input type="date" :disabled="$registration->id" name="start" value="{{ date('Y-m-d', strtotime(old('start', $registration->start ?? date('Y-m-d')))) }}" />
                </div>

                <div class="col-7 form-group">
                    <label>Aluno (<a href="{{ route('student.create') }}">Novo Aluno</a>)</label>
                    <x-form.select name="student_id" :disabled="$registration->id" class="select2" :options="$students" value="{{ old('student_id', $registration->student_id ?? '') }}" />
                </div>

                <div class="col-3 form-group">
                    <label>Modalidade</label>
                    <x-form.select name="modality_id" :disabled="$registration->id" :options="$modalities" value="{{ old('modality_id', $registration->modality_id ?? '') }}" />
                </div>

                <div class="col-2 form-group">
                    <label>Plano</label>
                    <x-form.select name="duration" :disabled="$registration->id" :options="classMonths()" value="{{ old('duration', $registration->duration ?? '') }}" />
                </div>

                <div class="col-2 form-group">
                    <label>Aulas p/ semana</label>
                    <x-form.input name="class_per_week" :disabled="$registration->id" value="{{ old('class_per_week', $registration->class_per_week ?? '') }}" />
                </div>

                <div class="col-2 form-group">
                    <label>Dia Vencimento</label>
                    <x-form.input name="due_day" :disabled="$registration->id" value="{{ old('due_day', $registration->due_day ?? date('d')) }}" />
                </div>

                

                <div class="col-2 form-group">
                    <label>Valor</label>
                    <x-form.input name="value" :disabled="$registration->id" class="money" value="{{ old('value', currency($registration->value) ?? '') }}" />
                </div>

                <div class="col-2 form-group">
                    <label>Pagto. 1º Mensalidade</label>
                    <x-form.select name="first_payment_method_id" :disabled="$registration->id" value="{{ old('first_payment_method_id', $registration->first_payment_method_id) }}" :options="$paymentMethods" />
                </div>

                <div class="col-2 form-group">
                    <label>Pagto. Demais Mensalidade</label>
                    <x-form.select name="other_payment_method_id" :disabled="$registration->id" value="{{ old('other_payment_method_id', $registration->other_payment_method_id) }}" :options="$paymentMethods" />
                </div>

                <div class="col-12 form-group">
                    <label>Observações</label>
                    <x-form.textarea name="comments" rows="3">{{ old('comments', $registration->comments ?? '') }}</x-form.textarea>
                </div>

                @if(empty($registration->id))
                <div class="col form-group">
                    <x-form.switch-button name="is_paid" value="">Marcar 1º Mensalidade como Pago</x-form.switch-button>
                </div>
                @endif
                
            </div>
        </div>
    </div>
</x-card>

<x-card style="primary" title="Aulas">
    
<table class="table table-stripesd table-bordersed">
    <thead class="thead-inverse">
        <tr>
            <th></th>
            @foreach(classWeek() as $k => $w)
            <th class="text-center">{{ $w }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Horário</th>
            @foreach(classWeek() as $i => $w)
            <td>
                <input type="hidden" name="class[{{ $i }}][weekday]" value="{{ $i }}">
                <x-form.select name="class[{{ $i }}][time]" :options="classTime()"
                    value="{{ old('class.'.$i.'.time', $weekclass['time'][$i] ?? '') }}" />
            </td>
            @endforeach
        </tr>
        <tr>
            <th>Professor</th>
            @foreach(classWeek() as $i => $w)
            <td>
                <x-form.select name="class[{{ $i }}][instructor_id]" :options="$instructors"
                    value="{{ old('class.'.$i.'.instructor_id', $weekclass['instructor'][$i] ?? '') }}" />
            </td>
            @endforeach
        </tr>
    </tbody>
</table>

<div id="accordion">
    <div class="accordion">
        <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="false">
            <h4>Calendário De Alunos</h4>
        </div>
        <div class="accordion-body collapse p-0 pt-2" id="panel-body-1" data-parent="#accordion" style="">
            <table class="table border" id="table-agenda">
                <thead class="theasd-dark">
                    <tr>
                        <th></th>
                        @foreach(classWeek() as $i => $week)
                        <th class="text-center border">{{ $week }}</th>
                        @endforeach

                    </tr>
                </thead>
                <tbody>

                    @foreach(classTime() as $k => $time)
                    <tr>
                        <th class="bg-lisght align-middle border">{{ $time }}</th>
                        @foreach(classWeek() as $i => $week)
                        <td width="16%" data-weekday="{{ $i }}" data-time="{{ $k }}" class="p-0 {{ (isset($classes[$k][$i]) && count($classes[$k][$i]) > 0) ? '' : '' }} text-center border align-middle {{ ($i % 2) ? 'bg-lsight' : '' }}">

                            @if(isset($classes[$k][$i]))
                            @foreach($classes[$k][$i] as $item)
                                <div><x-badge class="my-1" theme="{{ ($item['me'])  ? 'warning text-dark' : 'light' }}">{{ $item['name'] }}</x-badge></div>
                            @endforeach
                            @endif

                        </td>
                        @endforeach
                    </tr>
                    @endforeach



                </tbody>
            </table>

        </div>
    </div>
</div>
    <x-slot name="footer">
        <a name="" id="" class="btn btn-light text-dark" href="{{ route('registration.index') }}" role="button">
            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
            Voltar
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-check-circle    "></i>
            Salvar
        </button>
    </x-slot>
</x-card>

@section('css')
    <link rel="stylesheet" href="{{ asset('template/assets/bundles/select2/dist/css/select2.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.config.js') }}"></script>
    <script src="{{ asset('template/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $('#table-agenda td').click(function (e) { 
            e.preventDefault();
            
            weekday = $(this).data('weekday')
            time = $(this).data('time')

            $('[name="class['+weekday+'][time]"]').val(time).change()

        });
    </script>
@endsection

