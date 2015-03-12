<!DOCTYPE html>
<html>
<head>
    <title>DVD Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
    <nav>
        <div class="col-md-12">
            <ul class="nav nav-pills">
                @foreach($genres as $genre)
                <li role="presentation"><a href="/genres/{{$genre->genre_name}}/dvds">{{$genre->genre_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </nav>
    <div class="clearfix visible-lg-block"></div>
    <form action="/dvds" method="get">
        <div class="col-md-2">
            <div class="form-group">
                <label for="input_title">DVD Title</label>
                <input type="text" name="dvd_title">
            </div>
        </div>
        <div class="clearfix visible-lg-block"></div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Genre</label>
                <select class="form-control" name="genre_id">
                    <option value="0">All</option>
                    @foreach($genres as $genre)
                        <option value="{{$genre->id}}">{{$genre->genre_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="clearfix visible-lg-block"></div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Rating</label>
                <select class="form-control" name="rating_id">
                    <option value="0">All</option>
                    @foreach($ratings as $rating)
                        <option value="{{$rating->id}}">{{$rating->rating_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="clearfix visible-lg-block"></div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary" name="submit">Search</button>
        </div>
    </form>
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>