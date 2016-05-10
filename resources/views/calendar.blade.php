<?php header('Content-type: text/calendar; charset=utf-8');?>BEGIN:VCALENDAR{{"\r\n"}}
VERSION:2.0{{"\r\n"}}
PRODID:-//hacksw/handcal//NONSGML v1.0//EN{{"\r\n"}}
CALSCALE:GREGORIAN{{"\r\n"}}
@foreach($movies as $movie)
BEGIN:VEVENT{{"\r\n"}}
DTEND:{{date('Ymd\THis', strtotime($movie->release_date))}}{{"\r\n"}}
UID:{{$movie->id}}{{"\r\n"}}
DTSTAMP:{{date('Ymd\THis', strtotime($movie->release_date))}}{{"\r\n"}}
DESCRIPTION:{{$movie->title}}{{"\r\n"}}
URL;VALUE=URI:http://www.cinebound.com/movie/{{$movie->id}}{{"\r\n"}}
DTSTART:{{date('Ymd\THis', strtotime($movie->release_date))}}{{"\r\n"}}
END:VEVENT{{"\r\n"}}
@endforeach
END:VCALENDAR
