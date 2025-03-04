@extends('layouts.panel')
@section('title', 'Editar visita')
@section('content')
    <div class="card shadow">
        <div class="card-header border-1">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="mb-0">Editar visita</h2>
                </div>
                <div class="col text-right">
                    <a class="btn btn-sm btn-success"
                        href="{{ route('visits.index') }}">
                        <i class="fas fa-chevron-left"></i>
                        Regresar</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('visits.update', $visit) }}"
                method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="form-label"
                        for="modal_subject">Asunto</label>
                    <input class="form-control"
                        id="subject"
                        name="subject"
                        type="text"
                        value="{{ old('subject', $visit->subject) }}"
                        autofocus>
                    @error('subject')
                        <div class="mt-2 py-1 pl-2 alert alert-danger error-alert"
                            role="alert">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                @push('script')
                    <script>
                        $(document).ready(function() {
                            function getWeekday(selectedDate) {
                                const date = moment(selectedDate, 'DD/MM/YYYY HH:mm');
                                const weekday = date.format('dddd');
                                return weekday;
                            }

                            // Format the date to be displayed
                            function formatDate(dateStr) {
                                const date = moment(dateStr, 'DD/MM/YYYY').locale('es');
                                const formattedDate = date.format('dddd, D [de] MMMM [de] YYYY');
                                const today = moment().locale('es');
                                const tomorrow = moment().add(1, 'day').locale('es');
                                const dayAfterTomorrow = moment().add(2, 'day').locale('es');
                                if (date.isSame(today, 'day')) {
                                    return `Hoy, ${formattedDate}`;
                                } else if (date.isSame(tomorrow, 'day')) {
                                    return `Mañana, ${formattedDate}`;
                                } else if (date.isSame(dayAfterTomorrow, 'day')) {
                                    return `Pasado mañana, ${formattedDate}`;
                                } else {
                                    return formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1);
                                }
                            }

                            function getSelectedHour() {
                                const activeButton = $('.button-radio .btn.active');
                                const buttonText = activeButton.text();
                                const hourStr = buttonText.split(/\s-\s/)[0];
                                return !hourStr ? null : hourStr;
                            }

                            function getSelectedDate() {
                                const selectedDate = $('#datepicker-btn').datepicker('getFormattedDate');
                                return selectedDate;
                            }

                            $.fn.datepicker.dates['es'] = {
                                days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sabado"],
                                daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                                daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                                    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                                ],
                                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov",
                                    "Dic"],
                                today: "Hoy",
                                format: "dd/mm/yyyy",
                                titleFormat: "MM yyyy",
                                weekStart: 0
                            };

                            $('#datepicker-btn').datepicker({
                                language: 'es',
                                format: 'dd/mm/yyyy',
                                startDate: new Date(),
                                todayBtn: 'linked',
                                todayHighlight: true,
                                toggleActive: true,
                                daysOfWeekDisabled: [0, 6],
                            });

                            function getVisits(selectedDate) {
                                $.ajax({
                                    url: '{{ route('visits.get') }}',
                                    type: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    data: JSON.stringify({
                                        date: selectedDate
                                    }),

                                    success: function(response) {
                                        const visits = response.visits.map(visit => {
                                            const date = moment(visit.start_date).format('DD/MM/YYYY HH:mm');
                                            const datef = moment(visit.end_date).format('DD/MM/YYYY HH:mm');
                                            const date2 = moment(visit.start_date).format('DD/MM/YYYY HH:mm');
                                            const titulos = {
                                                    date: "Hora",
                                                    asunto: "Asunto",
                                                    name: "Nombre del visitante",
                                                    entity: "Entidad"
                                                };

                                            return {
                                                date: moment(date, 'DD/MM/YYYY HH:mm').format('HH:mm'),
                                                date2: {titulo: titulos.date, valor: moment(date, 'DD/MM/YYYY HH:mm').format('HH:mm') + " - " + moment(datef, 'DD/MM/YYYY HH:mm').format('HH:mm')},
                                                subject: {titulo: titulos.asunto, valor: visit.subject},
                                                name: {titulo: titulos.name, valor: visit.visitor.name},
                                                entity: {titulo: titulos.entity, valor: visit.visitor.entity},
                                            };

                                        });

                                        $('.button-radio button').prop('disabled', false);
                                        $('.button-radio button').removeAttr('title');
                                        
                                        visits.forEach(visit => {
                                                // Obtener el rango de horas de la visita (por ejemplo "08:00 - 10:00")
                                                const timeRange = visit.date2.valor.split(" - ");
                                                
                                                // Convertir las horas de inicio y fin a objetos moment
                                                const startHour = moment(timeRange[0], 'HH:mm');
                                                const endHour = moment(timeRange[1], 'HH:mm');

                                                // Iterar sobre el rango de horas entre la hora de inicio y la hora final
                                                while (startHour.isBefore(endHour)) {
                                                    // Formatear la hora actual como HH:mm
                                                    const formattedHour = startHour.format('HH:mm');
                                                    
                                                    // Deshabilitar el botón correspondiente a esa hora
                                                    $(`.button-radio button[value^="${formattedHour}"]`)
                                                        .prop('disabled', true)
                                                        .attr('title', `Ocupado: ${visit.subject.valor} - ${visit.name.valor}`);
                                                    
                                                    // Incrementar la hora en 30 minutos para la siguiente iteración
                                                    startHour.add(30, 'minutes');
                                                }
                                            });
                                            let contenido = "<ul>";
    
                                                for (let i = 0; i < visits.length; i++) {
                                                    const visit = visits[i];
                                                    // console.log(visit.subject);
                                                    contenido += "<li title='" + visit.subject.valor + "' style='padding: 5px;'>";
                                                    for (const prop in visit) {
                                                        if (prop !== 'date' && visit.hasOwnProperty(prop)) {
                                                            contenido += "<strong style='color: #172b4d; font-weight: 900; text-transform: uppercase;'>" + visit[prop].titulo + ":</strong> " + visit[prop].valor + ".<br> ";
                                                        }
                                                        // console.log(visit[prop].valor);
                                                        // console.log(visit.hasOwnProperty(prop));
                                                    }
                                                    contenido = contenido.slice(0, -2); // Elimina el último guion y espacio
                                                    contenido += ".</li>";
                                                }
    
                                                contenido += "</ul><br>";
    
                                                $("#visit").html(contenido);

                                        }
                                });
                            }

                            $('#datepicker-btn').on('changeDate', function() {
                                const isSelected = $(this).datepicker('getDate');
                                if (isSelected !== null) {
                                    const selectedDate = getSelectedDate();
                                    getVisits(selectedDate);
                                    $('#modal_entity').trigger('change');

                                    const formattedDate = formatDate(selectedDate);
                                    $('#datepicker-btn').html(
                                        `<i class="far fa-calendar-alt"></i>&nbsp;&nbsp;${formattedDate}`
                                    );
                                    $('#date').val(selectedDate);
                                } else {
                                    console.log("No date is selected");
                                    $('#datepicker-btn').html(
                                        `<i class="far fa-calendar-alt"></i>&nbsp;&nbsp;Fecha`
                                    );
                                    return
                                }
                            });

                            $('.button-radio button').click(function() {
                                if (!$(this).is(':disabled') && !$(this).hasClass('active')) {
                                    $(this).parent().find('.active').removeClass('active');
                                    $(this).addClass('active');

                                    $('#start_hour').val(moment(getSelectedHour(), 'HH:mm').format('HH:mm'));
                                } else if ($(this).hasClass('active')) {
                                    $(this).removeClass('active');
                                }
                            });

                            let oldDate = "{{ old('date') }}";
                            if (oldDate) {
                                const date = moment(oldDate, 'DD/MM/YYYY').toDate();
                                $('#datepicker-btn').datepicker('setDate', oldDate);

                                // Set the datepicker to today if today is not sunday or saturday
                            } else if (moment().isoWeekday() !== 6 && moment().isoWeekday() !== 7) {
                                $('#datepicker-btn').datepicker('setDate', new Date());
                            }

                            // Restore previous hour
                            let oldStartHour = "{{ old('start_hour') }}";
                            if (oldStartHour) {
                                const startHour = moment(oldStartHour, 'HH:mm').format('HH:mm');
                                const button = $(`.button-radio button:contains(${startHour})`);
                                button.trigger('click');
                            }

                            // Restore saved date
                            let savedDate = "{{ $visit->start_date }}";
                            if (savedDate) {
                                const date = new Date(savedDate);
                                $('#datepicker-btn').datepicker('setDate', date);

                                // Restore hour
                                const dateHour = moment(savedDate, 'YY-MM-DD HH:mm:ss').toDate();
                                const startHour = moment(dateHour, 'HH:mm').format('HH:mm');
                                // console.log(startHour);
                                const button = $(`.button-radio button:contains(${startHour})`);
                                // Enable the button
                                button.prop('disabled', false);
                                button.trigger('click');
                            }
                        });
                    </script>
                @endpush
                <div class="form-group">
                    <label class="form-label mb--1">
                        Seleccionar horario:
                        <span class="ml-1 badge-pill btn badge-info py-1"
                            id="datepicker-btn">
                            <i class="far fa-calendar-alt"></i>&nbsp;&nbsp;Fecha
                        </span>
                    </label>
                    <div class="button-radio d-flex flex-wrap flex-column flex-sm-row  mr--3 mt-2">
                        @php
                            $hours = ['08:00 - 08:30','08:30 - 09:00', '09:00 - 09:30', '09:30 - 10:00', '10:00 - 10:30', '10:30 - 11:00', '11:00 - 11:30', '11:30 - 12:00', '12:00 - 12:30', '12:30 - 13:00', '14:00 - 14:30', '14:30 - 15:00', '15:00 - 15:30', '15:30 - 16:00'];

                            // $hours = ['09:00 - 09:30', '09-30 - 10:00', '10:00 - 10:30', '10:30 - 11:00', '11:00 - 11:30', '11:30 - 12:00', '12:00 - 12:30', '12:30 - 13:00', '13:00 - 13:30', '13:30 - 14:00', '14:00 - 14:30', '14:30 - 15:00', '15:00 - 15:30', '15:30 - 16:00', '16:00 - 16:30', '16:30 - 17:00'];
                        @endphp
                        @foreach ($hours as $hour)
                            <button class="badge-pill btn btn-outline-primary px-lg-5 px-md-4 mr-3 mt-2"
                                type="button"
                                value="{{ $hour }}">{{ $hour }}</button>
                        @endforeach
                    </div>
                    @if ($errors->has('start_hour') || $errors->has('date'))
                        <div class="mt-2 py-1 pl-2 alert alert-danger error-alert"
                            role="alert">
                            @error('date')
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                <strong>{{ $message }}</strong><br>
                            @enderror
                            @error('start_hour')
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    @endif
                </div>
                <label class="form-label"
                    for="modal_visitor_id">Visitante:</label>
                <div class="form-group row"
                    id="visitorsContainer">
                    <div class="col pr-0">
                        <select class="form-control"
                            id="visitorsSelect"
                            name="visitor_id">
                            <option value=""
                                disabled
                                selected>Seleccione un visitante</option>
                            @foreach ($visitors as $visitor)
                                <option value="{{ $visitor->id }}"
                                    {{ old('visitor_id', $visit->visitor->id) === $visitor->id ? 'selected' : '' }}>
                                    {{ $visitor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-success form-control"
                            id="modal-launcher"
                            data-toggle="modal"
                            data-target="#add-new-visitor"
                            type="button"
                            modal-launcher>
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                @error('visitor_id')
                    <div class="mt--3 py-1 pl-2 alert alert-danger error-alert mb-3"
                        role="alert">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <div class="form-group mt-3">
                    <label class="form-label"
                        for="status">Seleccionar estado:</label>
                    <select class="form-control"
                        name="status"
                        title="Seleccionar estado">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}"
                                {{ old('status', $visit->status) === $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="mt-2 py-1 pl-2 alert alert-danger error-alert"
                            role="alert">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <input class="form-control"
                    id="date"
                    name="date"
                    value="{{ old('date') }}"
                    hidden>
                <input class="form-control"
                    id="start_hour"
                    name="start_hour"
                    type="text"
                    value="{{ old('start_hour') }}"
                    hidden>

                <div class="d-none">
                    <input name="user_id"
                        value="{{ auth()->user()->id }}">
                </div>
                <button class="btn btn-md btn-primary"
                    type="submit">Actualizar visita</button>
            </form>
        </div>
    </div>

    <div class="card mt-4 shadow">
        <div class="card card-frame">
            <div class="card-body">
                <h2 style='color: #172b4d; font-weight: 900;'>VISITAS PROGRAMADAS - OCUPADA</h2>
                   <span id="visit"></span>
            </div>
          </div>
    </div>

    <div class="modal fade"
        id="add-new-visitor"
        role="dialog"
        tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Añadir nuevo visitante:</h3>
                    <button class="discard-product close"
                        data-dismiss="modal"
                        type="button"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="modal_form">
                    <div class="modal-body pb-0 pt-0">
                        <div class="form-group">
                            <label class="form-label"
                                for="modal_name">Nombre del visitante:</label>
                            <input class="form-control"
                                id="modal_name"
                                name="modal_name"
                                type="text">
                            <div class="d-none"
                                id="modal_error_name">
                                <div class="mt-2 py-1 pl-2 alert alert-danger error-alert"
                                    role="alert">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    <strong id="modal_error_message_name"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"
                                form="modal_entity">Seleccionar entidad:</label>
                            <select class="form-control"
                                id="modal_entity"
                                name="modal_entity"
                                readonly>
                                @foreach ($entities as $entity)
                                    <option value="{{ $entity }}"
                                        {{ old('entity') === $entity ? 'selected' : '' }}>
                                        {{ $entity }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="d-none"
                                id="modal_error_entity">
                                <div class="mt-2 py-1 pl-2 alert alert-danger error-alert"
                                    role="alert">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    <strong id="modal_error_message_entity"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-none"
                            id="modal_ruc_display">
                            <label class="form-label"
                                for="modal_ruc">RUC:</label>
                            <input class="form-control"
                                id="modal_ruc"
                                name="modal_ruc"
                                type="text">
                            <div class="d-none"
                                id="modal_error_ruc">
                                <div class="mt-2 py-1 pl-2 alert alert-danger error-alert"
                                    role="alert">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    <strong id="modal_error_message_ruc"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="modal_dni_display">
                            <label class="form-label" for="modal_dni">DNI:</label>
                            <input class="form-control" id="modal_dni" name="modal_dni" type="text">
                            <div class="d-none" id="modal_error_dni">
                                <div class="mt-2 py-1 pl-2 alert alert-danger error-alert" role="alert">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    <strong id="modal_error_message_dni"></strong>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="button" id="checkDniButton" class="btn btn-primary">Consultar DNI</button>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="form-label"
                                for="modal_phone_number">Número de celular (opcional):</label>
                            <input class="form-control"
                                id="modal_phone_number"
                                name="modal_phone_number"
                                type="text">
                            <div class="d-none"
                                id="modal_error_phone_number">
                                <div class="mt-2 py-1 pl-2 alert alert-danger error-alert"
                                    role="alert">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    <strong id="modal_error_message_phone_number"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"
                                for="modal_email">Correo electrónico (opcional):</label>
                            <input class="form-control"
                                id="modal_email"
                                name="modal_email"
                                type="text">
                            <div class="d-none"
                                id="modal_error_email">
                                <div class="mt-2 py-1 pl-2 alert alert-danger error-alert"
                                    role="alert">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    <strong id="modal_error_message_email"></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-2">
                        <button class="discard-product btn btn-danger mr-2"
                            id="cancel-btn"
                            data-dismiss="modal"
                            type="button">Cancelar</button>
                        <button class="btn btn-md btn-success"
                            id="add-visitor"
                            type="submit">Crear visitante</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        function getFormData(formId) {
            const formElement = document.querySelector(`#${formId}`);
            const formData = new FormData(formElement);
            const data = Object.keys(Object.fromEntries(formData));
            return data;
        }

        // Get all the form-control selectors
        const formControls = document.querySelectorAll('select.form-control');
        const visitorChoices = new Choices('#visitorsSelect');

        let fields = getFormData('modal_form');
        fields = fields.map(field => field.replace('modal_', ''));
        const fieldValues = {};

        const fieldErrors = {};
        for (const field of fields) {
            fieldErrors[field] = {
                box: $(`#modal_error_${field}`),
                message: $(`#modal_error_message_${field}`)
            };
        }

        $("#cancel-btn").click(function(event) {
            $('#modal_form').trigger('reset');
            // Hide all the error boxes
            for (const field in fieldErrors) {
                fieldErrors[field].box.addClass('d-none');
            }
        });

        $("#add-visitor").click(function(event) {
            event.preventDefault();
            console.log(fields);
            for (const field of fields) {
                fieldValues[field] = $(`#modal_${field}`).val();
            };

            $.ajax({
                url: '{{ route('visitors.store') }}',
                type: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: JSON.stringify(fieldValues),

                success: function(response) {
                    console.log(response.message);
                    $('#add-new-visitor').modal('hide');
                    $('#cancel-btn').click();

                    // Add the new visitor to the select
                    visitorChoices.setChoices([{
                        value: response.id,
                        label: response.name,
                        selected: true
                    }], 'value', 'label', false)
                    Swal.fire({
                        icon: 'success',
                        title: '¡Visitante creado!',
                        text: `Visitante ${response.name} registrado con éxito`,
                        showConfirmButton: false,
                        timer: 2000
                    })
                },

                error: function(response) {
                    if (response.responseJSON) {
                        console.log(response.responseJSON.message);
                        const errors = response.responseJSON.errors;

                        for (const field in fieldErrors) {
                            const box = fieldErrors[field].box;
                            const message = fieldErrors[field].message;

                            if (errors[field]) {
                                box.removeClass('d-none');
                                message.text(errors[field]);
                            } else {
                                box.addClass('d-none');
                            }
                        }
                    }
                }
            })
        })
    </script>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('#modal_entity').on('change', function() {
                if (this.value === 'Persona jurídica') {
                    $('#modal_ruc_display').removeClass('d-none');
                    $('#modal_ruc').prop('disabled', false);
                    $('#modal_dni_display').addClass('d-none');
                    $('#modal_dni').prop('disabled', true);
                } else {
                    $('#modal_ruc_display').addClass('d-none');
                    $('#modal_ruc').prop('disabled', true);
                    $('#modal_dni_display').removeClass('d-none');
                    $('#modal_dni').prop('disabled', false);
                }
            });

            // Execute at least once
            $('#modal_entity').change();
        })
    </script>
@endpush

@push('script')
    <script>
     $(document).ready(function() {
            $('#checkDniButton').on('click', function() {
                var dni = $('#modal_dni').val();  

                if (dni) {
                    $.ajax({
                        url: '/visist/dni/' + dni,  
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if(!response.existe){
                                $('#modal_error_dni').addClass('d-none');  
                                $('#modal_name').val(response.nombreCompleto);
                            }else if (response.existe) {
                                $('#modal_error_dni').addClass('d-none');  
                                $('#modal_name').val(response.name);
                                $('#modal_phone_number').val(response.phone_number);
                                $('#modal_email').val(response.email);
                                $('#modal_name').prop('disabled', true);
                                $('#modal_phone_number').prop('disabled', true);
                                $('#modal_email').prop('disabled', true);
                            } else {
                                $('#modal_error_dni').removeClass('d-none');
                                $('#modal_error_message_dni').text('No se encontró la persona con el DNI proporcionado.');
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#modal_error_dni').removeClass('d-none');
                            $('#modal_error_message_dni').text('Hubo un error al procesar la solicitud.');
                        }
                    });
                } else {
                    $('#modal_error_dni').addClass('d-none');  
                }
            });
        });
    </script>
@endpush

<!-- Error handling script -->
@include('includes.form.error')
