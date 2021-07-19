@extends('layouts.app')
@section('title', 'Calender Basic')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/calendar.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Jadwal Latihan</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Jadwal Latihan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card box-shadow-title">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="d-flex">
                        <div id="lnb">
                            <div class="lnb-new-schedule text-center">
								@hasrole('Admin')
                                <a href="{{ route('schedules.detail.create', isset($schedule->id) ? $schedule->id : Auth::user()->id) }}"
                                    class="btn btn-sm btn-primary" id="btn-new-schedule">Tambah Kegiatan</a>
								@endhasrole
								@hasrole('instructor')
                                <a href="{{ route('schedules.detail.create', isset($schedule->id) ? $schedule->id : Auth::user()->id) }}"
                                    class="btn btn-sm btn-primary" id="btn-new-schedule">Tambah Kegiatan</a>
								@endhasrole
                            </div>
                        </div>
                        <div id="right">
                            <div id="menu">
                                <span class="dropdown">
                                    <button class="btn btn-default btn-sm dropdown-toggle" id="dropdownMenu-calendarType"
                                        type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i
                                            class="calendar-icon ic_view_month" id="calendarTypeIcon"
                                            style="margin-right: 4px;"></i><span id="calendarTypeName">Dropdown</span><i
                                            class="calendar-icon tui-full-calendar-dropdown-arrow"></i></button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-calendarType">
                                        <li role="presentation"><a class="dropdown-menu-title" role="menuitem"
                                                data-action="toggle-daily"><i
                                                    class="calendar-icon ic_view_day"></i>Daily</a></li>
                                        <li role="presentation"><a class="dropdown-menu-title" role="menuitem"
                                                data-action="toggle-weekly"><i
                                                    class="calendar-icon ic_view_week"></i>Weekly</a></li>
                                        <li role="presentation"><a class="dropdown-menu-title" role="menuitem"
                                                data-action="toggle-monthly"><i
                                                    class="calendar-icon ic_view_month"></i>Month</a></li>
                                        <li role="presentation"><a class="dropdown-menu-title" role="menuitem"
                                                data-action="toggle-weeks2"><i class="calendar-icon ic_view_week"></i>2
                                                weeks</a></li>
                                        <li role="presentation"><a class="dropdown-menu-title" role="menuitem"
                                                data-action="toggle-weeks3"><i class="calendar-icon ic_view_week"></i>3
                                                weeks</a></li>
                                        <li class="dropdown-divider" role="presentation"></li>
                                        <li role="presentation"><a role="menuitem" data-action="toggle-workweek">
                                                <input class="tui-full-calendar-checkbox-square" type="checkbox"
                                                    value="toggle-workweek" checked=""><span
                                                    class="checkbox-title"></span>Show weekends</a>
                                        </li>
                                        <li role="presentation"><a role="menuitem" data-action="toggle-start-day-1">
                                                <input class="tui-full-calendar-checkbox-square" type="checkbox"
                                                    value="toggle-start-day-1"><span class="checkbox-title"></span>Start
                                                Week on Monday</a>
                                        </li>
                                        <li role="presentation"><a role="menuitem" data-action="toggle-narrow-weekend">
                                                <input class="tui-full-calendar-checkbox-square" type="checkbox"
                                                    value="toggle-narrow-weekend"><span
                                                    class="checkbox-title"></span>Narrower than weekdays</a>
                                        </li>
                                    </ul>
                                </span>
                                <span id="menu-navi">
                                    <button class="btn btn-default btn-sm move-today" type="button"
                                        data-action="move-today">Today</button>
                                    <button class="btn btn-default btn-sm move-day" type="button" data-action="move-prev"><i
                                            class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i></button>
                                    <button class="btn btn-default btn-sm move-day" type="button" data-action="move-next"><i
                                            class="calendar-icon ic-arrow-line-right"
                                            data-action="move-next"></i></button></span><span class="render-range"
                                    id="renderRange"></span>
                            </div>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/calendar/tui-code-snippet.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/tui-time-picker.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/tui-date-picker.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/chance.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/tui-calendar.js') }}"></script>
    <script>
        var cal = new tui.Calendar('#calendar', {
            defaultView: 'month',
            taskView: true,
            template: {
                monthDayname: function(dayname) {
                    return '<span class="calendar-week-dayname-name">' + dayname.label + '</span>';
                }
            }
        });
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "{{ route('schedules.detail.json', isset($schedule->id) ? $schedule->id : Auth::user()->id) }}",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    console.log(data);
                    cal.createSchedules(data);
                }
            });
        });
        $('#menu-navi').on('click', onClickNavi);

        function onClickNavi(e) {
            var action = getDataAction(e.target);

            switch (action) {
                case 'move-prev':
                    cal.prev();
                    break;
                case 'move-next':
                    cal.next();
                    break;
                case 'move-today':
                    cal.today();
                    break;
                default:
                    return;
            }

            // setRenderRangeText();
            // setSchedules();
        }
    </script>
@endsection
