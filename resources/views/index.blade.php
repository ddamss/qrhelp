<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    
    @foreach ($members as $member)
    <ul>
        <li>first name : {{$member->first_name}}</li>
        <li>last name : {{$member->last_name}}</li>
        <li>address : {{$member->address}}</li>
        <li>mobile number : {{$member->mobile_number}}</li>
    </ul>
        <img src="{{$member->image}}">

        <hr>
    @endforeach
</body>
</html>