<!DOCTYPE html>
<html>
<head>
    <title>Add DVD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>
    @if (Session::has('success'))
        <div class="col-md-2">    
            <div class="alert alert-success" role="alert">Dvd Submitted</div>
        </div>
        <div class="clearfix visible-lg-block"></div>
    @endif
    <form action="/dvds" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-md-2">
            <div class="form-group">
                <label for="input_title">DVD Title</label>
                <input type="text" name="dvd_title">
            </div>
        </div>
        <div class="clearfix visible-lg-block"></div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Label</label>
                <select class="form-control" name="label_id">
                    @foreach($labels as $label)
                        <option value="{{$label->id}}">{{$label->label_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="clearfix visible-lg-block"></div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Sound</label>
                <select class="form-control" name="sound_id">
                    @foreach($sounds as $sound)
                        <option value="{{$sound->id}}">{{$sound->sound_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="clearfix visible-lg-block"></div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Genre</label>
                <select class="form-control" name="genre_id">
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
                    @foreach($ratings as $rating)
                        <option value="{{$rating->id}}">{{$rating->rating_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="clearfix visible-lg-block"></div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Format</label>
                <select class="form-control" name="format_id">
                    @foreach($formats as $format)
                        <option value="{{$format->id}}">{{$format->format_name}}</option>
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