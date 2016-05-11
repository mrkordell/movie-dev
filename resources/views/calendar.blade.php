BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
CALSCALE:GREGORIAN
@foreach($movies as $movie)
BEGIN:VEVENT
DTEND:{{date('Ymd\THis', strtotime($movie->release_date))}}
UID:{{$movie->id}}
DTSTAMP:{{date('Ymd\THis', strtotime($movie->release_date))}}
SUMMARY:{{$movie->title}}
URL;VALUE=URI:http://www.cinebound.com/movie/{{$movie->id}}
DTSTART:{{date('Ymd\THis', strtotime($movie->release_date))}}
END:VEVENT
@endforeach
END:VCALENDAR
