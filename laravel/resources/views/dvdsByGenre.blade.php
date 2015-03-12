<!DOCTYPE html>
<html>
<head>
    <title>Dvds with Genre {{$genreName}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>
    <p>Genre: {{$genreName}}</p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Rating</th>
                <th>Genre</th>
                <th>Label</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dvds as $dvd)
                <tr>
                    <td>{{$dvd->title}}</td>
                    @if(count($dvd->ratings))
                        <td>{{$dvd->ratings->rating_name}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                    
                    @if(count($dvd->genres))
                        <td>{{$dvd->genres->genre_name}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                    
                    @if(count($dvd->labels))
                        <td>{{$dvd->labels->label_name}}</td>
                    @else
                        <td>N/A</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>