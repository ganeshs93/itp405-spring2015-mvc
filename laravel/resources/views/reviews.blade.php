<!DOCTYPE html>
<head>
    @if($dvd)
        <title>{{$dvd->title}} Ratings</title>
    @else
        <title>Invalid DVD</title>
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>
@if($dvd)
    <div class="container">
        <h1>Movie Information</h1>
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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$dvd->title}}</td>
                    <td>{{$dvd->rating_name}}</td>
                    <td>{{$dvd->genre_name}}</td>
                    <td>{{$dvd->label_name}}</td>
                    <td>{{$dvd->sound_name}}</td>
                    <td>{{$dvd->format_name}}</td>
                    <td>{{date('F d, Y h:mA', strtotime($dvd->release_date))}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container">
        <h1>Submit Review</h1>
        @if($errors->count()>0)
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Invalid Review</h3>
                </div>
                <div class="panel-body">
                    @foreach ($errors->all() as $error)
                        <p style="color:red">{{$error}}</p>
                    @endforeach
                </div>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Review submitted</h3>
                </div>
                <div class="panel-body">
                    <p>{{Session::get('success')}}</p>
                </div>
            </div>
        @endif
        <form method="post" action="/dvds/{{$dvd->id}}/submit_review">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <label>Title</label>
                <input name="title" class="form-control" value="{{Request::old('title')}}">   
            </div>
            <div class="form-group">
                <label>Rating</label>
                <select class="form-control" name="rating">
                    @for ($i = 1; $i < 11; $i++)
                        @if (Request::old('rating') == $i)
                            <option value="{{$i}}" selected="true">{{$i}}</option>
                        @else
                            <option value="{{$i}}">{{$i}}</option>
                        @endif
                    @endfor
                </select>
            </div> 
            <div class="form-group">
                <label>Review</label>
                <textarea name="review" class="form-control" rows="3">{{Request::old('review')}}</textarea>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    <br>
    @if($reviews)
        <div class="container">
            <h1>All Reviews</h1>
            @foreach($reviews as $review)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$review->title}} ({{$review->rating}}/10)</h3>
                    </div>
                    <div class="panel-body">{{$review->description}}</div>
                </div>
            @endforeach
        </div>
    @else
        <div class="container">
            <h1>All Reviews</h1>
            <p>No Reviews Yet</p>
        </div>
    @endif
@else
    <p>DVD does not exist</p>
@endif
    
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>