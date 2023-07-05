<!DOCTYPE html>
<html>
<head>
    <title>calendario</title>
<link href="https://fullcalendar.io/releases/core/4.0.2/main.min.css" rel="stylesheet"/>
    
<link href="https://fullcalendar.io/releases/timeline/4.0.2/main.min.css" rel="stylesheet"/>

<link href="https://fullcalendar.io/releases/resource-timeline/4.0.2/main.min.css"/>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
html, body {
  margin: 0;
  padding: 0;
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}

#calendar {
  max-width: 900px;
  margin: 40px auto;
}    
</style>
</head>
<body>
<div id='calendar'></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'interaction', 'resourceTimeline' ],
    locale: 'es',
    timeZone: 'America/Lima',
    header: {
      left: 'today prev,next',
      center: 'title',
     // right: 'resourceTimelineDay,resourceTimelineTenDay,resourceTimelineMonth,resourceTimelineYear'
      right: 'resourceTimelineDay, resourceTimelineMonth'
    },
    defaultView: 'resourceTimelineMonth',
    scrollTime: '08:00',
    aspectRatio: 1.5,
    views: {
      resourceTimelineDay: {
        buttonText: '30 dias',
        slotDuration: '00:00:03'
      },
      resourceTimelineTenDay: {
        type: 'resourceTimeline',
        duration: { days: 30 },
        buttonText: '30 days'
      }
    },
    editable: true,
    resourceColumns: [
      {
        labelText: 'Room',
        field: 'title'
      },
//      {
//        labelText: 'Estado',
//        field: 'occupancy'
//      }
    ],
    resourceLabelText: 'Habitaciones',
    resources: [{"id":"1","title":"Simple 101"},
                {"id":"2","title":"Simple 102"},
                {"id":"3","title":"Simple 103"},
                {"id":"4","title":"Simple 104"},
                {"id":"5","title":"Doble 201"},
                {"id":"6","title":"Doble 202"},
                {"id":"7","title":"Doble 203"},
                {"id":"8","title":"Triple 204"},
                {"id":"9","title":"Triple 301"},
                {"id":"10","title":"Triple 302"},
                {"id":"11","title":"Matrimonial 303"},
                {"id":"12","title":"Matrimonial 304"}],
//    events: 'https://fullcalendar.io/demo-events.json?single-day&for-resource-timeline'
    events: [{"resourceId":"1","title":"Pedro Suarez","start":"2019-04-03","end":"2019-04-04","eventColor":"orange"},
             {"resourceId":"1","title":"Raul Romero","start":"2019-04-05","end":"2019-04-12", "eventColor":"green"}, 
             {"resourceId":"3","title":"Curwen D.","start":"2019-04-04","end":"2019-04-12", "eventColor":"red"},
             {"resourceId":"4","title":"Fiuza Paloma","start":"2019-04-04","end":"2019-04-10", "eventColor":"green"},
             {"resourceId":"7","title":"Cesar Rodriguez","start":"2019-04-04","end":"2019-04-09", "eventColor":"green"},
             {"resourceId":"6","title":"Hugox Chugox","start":"2019-04-04","end":"2019-04-07", "eventColor":"green"}]
  });

  calendar.render();
});    
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://fullcalendar.io/releases/core/4.0.2/main.min.js"></script>
<script src="https://fullcalendar.io/releases/core/4.0.2/locales-all.js"></script>
<script src="https://fullcalendar.io/releases/interaction/4.0.2/main.min.js"></script>
<script src="https://fullcalendar.io/releases/timeline/4.0.2/main.min.js"></script>
<script src="https://fullcalendar.io/releases/resource-common/4.0.2/main.min.js"></script>
<script src="https://fullcalendar.io/releases/resource-timeline/4.0.2/main.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>