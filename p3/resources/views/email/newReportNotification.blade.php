<!DOCTYPE html>
<html>
<head>
    <title>Testing Email</title>
</head>
<body>
    <p><strong>A new Observer Report was just submitted.</strong></p>
    <p>Report Id: {{ $report->id }}</p>
    <p>Date Observed: {{ $report->date_observed}}</p>
    <p>Location: {{$report->street_number}} {{$report->street_name}}
    <p>By {{$report->observer_first_name}} {{$report->observer_last_name}},  {{$report->observer_email}}</p>
    <p>Comments: <br>{{$report->comments}}</p>
   
    <p><img src="{{$photo->url}}"></p>
    <p>{{$photo->caption}}</p>
</body>
</html>