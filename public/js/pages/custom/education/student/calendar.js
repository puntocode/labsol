/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/*!******************************************************************!*\
  !*** ../demo7/src/js/pages/custom/education/student/calendar.js ***!
  \******************************************************************/


var KTAppsEducationStudentCalendar = function() {

    return {
        //main function to initiate the module
        init: function() {
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

            var calendarEl = document.getElementById('kt_calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                themeSystem: 'bootstrap',

                isRTL: KTUtil.isRTL(),

                header: {
                    left: 'prev,siguiente hoy',
                    center: 'title',
                    right: 'timeGridDay,timeGridWeek,dayGridMonth,listYear'
                },

                height: 800,
                contentHeight: 780,
                aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                nowIndicator: true,
                now: TODAY + 'T09:25:00', // just for demo

                views: {
                    listYear: {buttonText: 'Año'},
                    dayGridMonth: { buttonText: 'Mes' },
                    timeGridWeek: { buttonText: 'Semana' },
                    timeGridDay: { buttonText: 'Día' }
                },

                defaultView: 'dayGridMonth',
                defaultDate: TODAY,

                editable: true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                events: [
                    {
                        title: 'Actividad 1',
                        start: YM + '-01',
                        description: 'Cliente 1',
                        className: "fc-event-light fc-event-solid-warning"
                    },
                    {
                        title: 'Actividad 5',
                        start: YM + '-14T13:30:00',
                        description: 'Cliente 1',
                        end: YM + '-14',
                        className: "fc-event-light fc-event-solid-danger"
                    },
                    {
                        title: 'Vacaciones',
                        start: YM + '-02',
                        description: 'Técnico 2',
                        end: YM + '-03',
                        className: "fc-event-primary"
                    },
                    {
                        title: 'Actividad 2',
                        start: YM + '-12',
                        description: 'Cliente 1',
                        end: YM + '-10',
                        className: "fc-event-light fc-event-solid-info"
                      },
                    {
                        id: 999,
                        title: 'Reunión',
                        start: YM + '-09T16:00:00',
                        description: 'Cliente 3',
                        className: "fc-event-light fc-event-solid-warning"
                    },
                    {
                        id: 1000,
                        title: 'Actividad 3',
                        description: 'Equipo 1',
                        start: YM + '-16T16:00:00',
                        className: "fc-event-light fc-event-solid-primary"
                    },
                    {
                        title: 'Actividad 1',
                        start: YESTERDAY,
                        end: TOMORROW,
                        description: 'Cliente 1',
                        className: "fc-event-light fc-event-solid-warning"
                    },
                    {
                        title: 'Actividad 2',
                        start: TODAY + 'T10:30:00',
                        end: TODAY + 'T12:30:00',
                        description: 'Cliente 1',
                        className: "fc-event-light fc-event-solid-success"
                    },
                    {
                        title: 'Actividad 3',
                        start: TODAY + 'T12:00:00',
                        className: "fc-event-info",
                        description: 'Cliente 2',
                        className: "fc-event-light fc-event-solid-secondary"
                    },
                    {
                        title: 'Reunión',
                        start: TODAY + 'T14:30:00',
                        className: "fc-event-light fc-event-solid-warning",
                        description: 'Cliente 3'
                    },
                    {
                        title: 'Actividad 1',
                        start: TODAY + 'T17:30:00',
                        className: "fc-event-light fc-event-solid-primary",
                        description: 'Cliente 1'
                    },
                    {
                        title: 'Permiso',
                        start: TOMORROW + 'T05:00:00',
                        className: "fc-event-primary",
                        description: 'Técnico 1'
                    },
                    {
                        title: 'Actividad 2',
                        start: TOMORROW + 'T07:00:00',
                        className: "fc-event-light fc-event-solid-warning",
                        description: 'Cliente 1'
                    },
                    {
                        title: 'Actividad 4',
                        // url: 'http://google.com/',
                        start: YM + '-28',
                        className: "fc-event-solid-info fc-event-light",
                        description: 'Cliente 4'
                    }
                ],

                eventRender: function(info) {
                    var element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                }
            });

            calendar.render();
        }
    };
}();

jQuery(document).ready(function() {
    KTAppsEducationStudentCalendar.init();
});

/******/ })()
;
//# sourceMappingURL=calendar.js.map
