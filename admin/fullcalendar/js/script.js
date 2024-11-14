var calendar;
var Calendar = FullCalendar.Calendar;

$(function() {
    var events = calendarEvents || [];

    calendar = new Calendar(document.getElementById('calendar'), {
        headerToolbar: {
            left: 'prev,next today',
            right: 'dayGridMonth,dayGridWeek,list',
            center: 'title',
        },
        selectable: true,
        themeSystem: 'bootstrap',
        events: events, // Load events directly from PHP data

        eventRender: function(info) {
            // Ensure we have both start and end time for the event
            var startDate = info.event.start;
            var endDate = info.event.end;

            // Only proceed if both start and end dates are available
            if (startDate && endDate) {
                var eventElement = info.el; // The DOM element representing the event

                // Calculate the time difference in hours or minutes to set the width
                var startDateTime = startDate.getTime();
                var endDateTime = endDate.getTime();
                var duration = endDateTime - startDateTime; // Duration in milliseconds

                // Calculate percentage width of the event in the calendar grid
                var calendarWidth = $(eventElement).parent().width();  // Full calendar width
                var eventDurationInMinutes = duration / (1000 * 60); // Convert to minutes
                var eventStartInMinutes = (startDate.getHours() * 60) + startDate.getMinutes(); // Start time in minutes of the day
                var totalDayMinutes = 1440; // 24 hours * 60 minutes in a day

                // Calculate the left offset and width percentage based on event start time and duration
                var eventLeft = (eventStartInMinutes / totalDayMinutes) * 100;  // Percentage of the day passed
                var eventWidth = (eventDurationInMinutes / totalDayMinutes) * 100;  // Percentage of the day this event takes

                // Create a custom blue line that spans from start to end date
                var markerLine = document.createElement('div');
                markerLine.style.position = 'absolute';
                markerLine.style.left = eventLeft + '%';  // Position marker at event's start
                markerLine.style.top = '0';  // Align to the top of the event
                markerLine.style.width = eventWidth + '%';  // Span to the end date
                markerLine.style.height = '100%';  // Full height of the event
                markerLine.style.backgroundColor = 'blue';  // Blue color for the marker

                // Append the marker line to the event element
                eventElement.appendChild(markerLine);
            }
        },

        eventClick: function(info) {
            var _details = $('#event-details-modal');
            var id = info.event.id;

            var eventData = events.find(event => event.id == id);
            if (eventData) {
                _details.find('#title').text(eventData.title);
                _details.find('#description').text(eventData.description || "No description available.");
                _details.find('#start').text(new Date(eventData.start).toLocaleString());
                _details.find('#end').text(new Date(eventData.end).toLocaleString());
                _details.find('#edit, #delete').attr('data-id', id);
                _details.modal('show');
            } else {
                alert("Event is undefined");
            }
        },

        editable: true
    });

    calendar.render();
});
