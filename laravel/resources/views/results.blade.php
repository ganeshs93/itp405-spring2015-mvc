<!DOCTYPE html>
<html>
<head>
    <title>DVD Results</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
    <p>
        You searched for <?php echo $search_term ?> in genre <?php echo $genre_chosen ?> with rating <?php echo $rating_chosen ?>
    </p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Rating</th>
                <th>Genre</th>
                <th>Label</th>
                <th>Sound</th>
                <th>Format</th>
                <th>Release Date</th>
                <th>Critic Score</th>
                <th>Audience Score</th>
                <th>Poster</th>
                <th>Runtime</th>
                <th>Cast</th>
            </tr>
        </thead>
        <tbody>
            @for($x = 0; $x < count($dvds); $x++)
                <?php $dvd = $dvds[$x]; ?>
                <tr>
                    <td><?php echo $dvd->title ?><a href="/dvds/<?php echo $dvd->id ?>"> (Review)</a></td>
                    <td><?php echo $dvd->rating_name ?></td>
                    <td><?php echo $dvd->genre_name ?></td>
                    <td><?php echo $dvd->label_name ?></td>
                    <td><?php echo $dvd->sound_name ?></td>
                    <td><?php echo $dvd->format_name ?></td>
                    <td><?php echo date('F d, Y h:mA', strtotime($dvd->release_date)) ?></td>
                    @if($x < count($rtResults) && $rtResults[$x])
                        <td>{{$rtResults[$x]->criticScore}}</td>
                        <td>{{$rtResults[$x]->audienceScore}}</td>
                        <td><img src="{{$rtResults[$x]->image}}"></td>
                        <td>{{$rtResults[$x]->runtime}}</td>
                        <td>{{$rtResults[$x]->abridgedCast}}</td>
                    @else
                        <td>N/A</td>
                        <td>N/A</td>
                        <td>N/A</td>
                        <td>N/A</td>
                        <td>N/A</td>
                    @endif
                </tr>
            @endfor
        </tbody>
    </table>
    
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>