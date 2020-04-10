<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<button type="button" class="btn btn-outline-primary btn-rounded waves-effect" style="display:inline-block;margin-left:50px;font-size:13px;">
    <a href="{{route('members.create')}}" style="text-decoration: none;color:inherit;">Create new member</a>
</button>


    @foreach ($members as $member)
    <ul>
        <li><b>first name</b> : {{$member->first_name}}</li>
        <li><b>last name</b> : {{$member->last_name}}</li>
        <li><b>address</b> : {{$member->address}}</li>
        <li><b>mobile number </b>: {{$member->mobile_number}}</li>
    </ul>
        <img src="{{$member->image}}">

        <hr>
    @endforeach
</body>
</html>