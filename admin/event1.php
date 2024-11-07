<!DOCTYPE html>
<html>
  <head>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar')
        const calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        })
        calendar.render()
      })

    </script>
  </head>
  <body>
   <div class="row">
    <div class="col-md-8">
        <div class="card">
        <div id='calendar'></div>
        </div>
    </div>
   </div>
  </body>
</html>