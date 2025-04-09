@extends('layouts.owner.home')

@section('css')
    <link rel="stylesheet" href="{{ asset('templatesAdminLTE/plugins/fullcalendar/main.css') }}">
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/instascan@2"></script>
@endsection
@section('content')
    <!-- Main Content -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                    <div class="col-sm-6 mx-auto">
                        <div id="reader"></div>
                        <div id="result"></div>
                    </div><!-- /.col -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('script')
    <script src="{{ asset('templatesAdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('templatesAdminLTE/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('templatesAdminLTE/plugins/fullcalendar/main.js') }}"></script>
    <script>
        $(function() {


            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------



            var events = [];
            $(document).ready(function() {
                $.ajax({
                    url: "{{ url('api/get-calendar') }}?id=" + {{ Auth::user()->id }},
                    dataType: 'json',
                    cache: false,
                    dataSrc: '',

                    success: function(data) {
                        for (i = 0; i < data.length; i++) {
                            //Date for the calendar events (dummy data)
                            var date = new Date(data[i].date)
                            var d = date.getDate(),
                                m = date.getMonth(),
                                y = date.getFullYear()
                            if (data[i].status == 1) {
                                events.push({
                                    title: data[i].field + '-' + data[i].venue,
                                    start: new Date(y, m, d, data[i].hour_start, data[i]
                                        .minute_start),
                                    end: new Date(y, m, d, data[i].hour_end, data[i]
                                        .minute_end),
                                    allDay: false,
                                    url: '{{ route('owner.booking.index') }}/' + data[i]
                                        .rent_id,
                                    backgroundColor: '#707371',
                                    borderColor: '#707371'
                                });
                            } else if (data[i].status == 2) {
                                events.push({
                                    title: data[i].field + '-' + data[i].venue,
                                    start: new Date(y, m, d, data[i].hour_start, data[i]
                                        .minute_start),
                                    end: new Date(y, m, d, data[i].hour_end, data[i]
                                        .minute_end),
                                    allDay: false,
                                    url: '{{ route('owner.booking.index') }}/' + data[i]
                                        .rent_id,
                                    backgroundColor: '#2ab1f5',
                                    borderColor: '#2ab1f5'
                                });
                            } else if (data[i].status == 3) {
                                events.push({
                                    title: data[i].field + '-' + data[i].venue,
                                    start: new Date(y, m, d, data[i].hour_start, data[i]
                                        .minute_start),
                                    end: new Date(y, m, d, data[i].hour_end, data[i]
                                        .minute_end),
                                    allDay: false,
                                    url: '{{ route('owner.booking.index') }}/' + data[i]
                                        .rent_id,
                                    backgroundColor: '#e31010',
                                    borderColor: '#e31010'
                                });
                            } else {
                                events.push({
                                    title: data[i].field + '-' + data[i].venue,
                                    start: new Date(y, m, d, data[i].hour_start, data[i]
                                        .minute_start),
                                    end: new Date(y, m, d, data[i].hour_end, data[i]
                                        .minute_end),
                                    allDay: false,
                                    url: '{{ route('owner.booking.index') }}/' + data[i]
                                        .rent_id,
                                    backgroundColor: '#1c70c9',
                                    borderColor: '#1c70c9'
                                });
                            }
                        }
                        var calendar = new Calendar(calendarEl, {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            themeSystem: 'bootstrap',
                            //Random default events
                            events: events,
                            editable: true,
                            droppable: true, // this allows things to be dropped onto the calendar !!!
                            drop: function(info) {
                                // is the "remove after drop" checkbox checked?
                                if (checkbox.checked) {
                                    // if so, remove the element from the "Draggable Events" list
                                    info.draggedEl.parentNode.removeChild(info
                                        .draggedEl);
                                }
                            }
                        });
                        calendar.render();
                    }

                });
            });



            // $('#calendar').fullCalendar()

            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            // Color chooser button
            $('#color-chooser > li > a').click(function(e) {
                e.preventDefault()
                // Save color
                currColor = $(this).css('color')
                // Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
            })
            $('#add-new-event').click(function(e) {
                e.preventDefault()
                // Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                // Create events
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.text(val)
                $('#external-events').prepend(event)

                // Add draggable funtionality
                ini_events(event)

                // Remove event from text input
                $('#new-event').val('')
            })
        })
    </script>

    <script>
        const scanner = new Html5QrcodeScanner('reader', {
            qrbox: {
                width: 250,
                height: 250
            },
            fps: 20,

        })

        scanner.render(success, error)

        function success(result) {
            console.log(result)
            document.getElementById('result').innerHTML = `

            <a href="${result}" class="bg-success px-2 py-1 rounded" >${result}<a/>
            `
            window.location.href = result;
            scanner.clear()
            document.getElementById('reader').remove()
        }

        function error(error) {
            console.log(error)
        }
    </script>

    <script>
        const scanner = new Html5QrcodeScanner('reader', {
            qrbox: {
                width: 250,
                height: 250
            },
            fps: 20,

        })

        scanner.render(success, error)

        function success(result) {
            console.log(result)
            document.getElementById('result').innertext = `

            <a href="${result}">${result}<a/>
            `
            window.location.href = result;
            scanner.clear()
            document.getElementById('reader').remove()
        }

        function error(error) {
            console.log(error)
        }
    </script>
@endsection
