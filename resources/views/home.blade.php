@extends('layouts.panel')
@section('title', 'Inicio')
@section('content')
  <style>
    // Display the header below the menu bar
    .fc .fc-toolbar.fc-header-toolbar {
      z-index: 0;
    }
    .fc .fc-button-group {
        z-index: 0;
    }
  </style>
  <div class="row">
    <div class="col-md-12 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card shadow col">
            <div class="card-body border-1">
              <div class="row align-items-center">
                <div class="col">
                  <div id="calendar">
                    @push('script')
                      <script>
                        const calendarEl = document.getElementById('calendar');
                        const calendar = new FullCalendar.Calendar(calendarEl, {
                          views: {
                            timeGridDay: {
                              allDaySlot: false,
                              allDayText: false,
                            },
                            timeGridWeek: {
                              allDaySlot: false,
                              allDayText: false,
                            }
                          },
                          // Hide saturday and sunday
                          hiddenDays: [6, 0],
                          slotMinTime: '08:00:00',
                          slotMaxTime: '17:00:00',
                          slotDuration: '00:05:00',
                          slotLabelInterval: '00:30:00',
                          //   slotLabelInterval: '00:30:00',
                          slotLabelFormat: {
                            hour: 'numeric',
                            minute: '2-digit',
                            omitZeroMinute: false,
                            meridiem: 'short'
                          },
                          noEventsText: 'No hay más visitas para mostrar',
                          initialView: 'timeGridWeek',
                          locale: 'es',
                          buttonText: {
                            today: 'Hoy',
                            month: 'Mes',
                            week: 'Semana',
                            day: 'Día',
                            list: 'Lista'
                          },
                          headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'listWeek,timeGridWeek,dayGridMonth',
                          },
                          height: 'auto',
                        });
                        calendar.render();

                        calendar.setOption('rerenderDelay', 1);

                        const visits = @json($visits);
                        // Get colors
                        const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--primary');
                        const successColor = getComputedStyle(document.documentElement).getPropertyValue('--success');
                        const dangerColor = getComputedStyle(document.documentElement).getPropertyValue('--danger');
                        // Create a new event per each visit
                        visits.forEach(visit => {
                          console.log(visit);
                          calendar.addEvent({
                            title: visit.subject,
                            start: visit.start_date,
                            end: visit.end_date,
                            allDay: false,
                            textColor: visit.status === 'Pendiente' ? primaryColor : visit.status === 'Confirmado' ?
                              successColor : dangerColor,
                            textColor: 'white',
                            backgroundColor: visit.status === 'Pendiente' ? primaryColor : visit.status === 'Confirmado' ?
                              successColor : dangerColor,
                            borderColor: visit.status === 'Pendiente' ? primaryColor : visit.status === 'Confirmado' ?
                              successColor : dangerColor,
                            classNames: ['font-weight-bold','text-center'],
                          });
                        });

                        // Based on the screen size, display the proper view
                        const changeView = () => {
                          const mediaQuery = window.matchMedia('(max-width: 992px)');
                          if (mediaQuery.matches) {
                            calendar.changeView('listWeek');
                            calendar.setOption('headerToolbar', {
                              left: null,
                              center: 'prev,next today',
                              right: null,
                            });
                          } else {
                            calendar.changeView('timeGridWeek');
                            calendar.setOption('headerToolbar', {
                              left: 'prev,next today',
                              center: 'title',
                              right: 'listWeek,timeGridWeek,dayGridMonth',
                            });
                          }
                        }

                        // Run at least once, when the page loads
                        changeView();

                        // Update calendar view on window resize
                        window.addEventListener('resize', changeView);
                      </script>
                    @endpush
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
