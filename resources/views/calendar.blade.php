BEGIN:VCALENDAR{{"\r\n"}}VERSION:2.0{{"\r\n"}}PRODID:-//hacksw/handcal//NONSGML v1.0//EN{{"\r\n"}}CALSCALE:GREGORIAN
@foreach($movies as $movie){{"\r\n"}}BEGIN:VEVENT{{"\r\n"}}DTEND:{{date('Ymd\THis', strtotime($movie->release_date))}}{{"\r\n"}}UID:{{$movie->id}}{{"\r\n"}}DTSTAMP:{{date('Ymd\THis', strtotime($movie->release_date))}}{{"\r\n"}}SUMMARY:{{$movie->title}}{{"\r\n"}}URL;VALUE=URI:http://www.cinebound.com/movie/{{$movie->id}}{{"\r\n"}}DTSTART:{{date('Ymd\THis', strtotime($movie->release_date))}}{{"\r\n"}}END:VEVENT
@endforeach{{"\r\n"}}END:VCALENDAR
