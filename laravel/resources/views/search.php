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
                    <?php foreach($genres as $genre) : ?>
                        <option value="<?php echo $genre->id ?>"><?php echo $genre->genre_name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="clearfix visible-lg-block"></div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Rating</label>
                <select class="form-control" name="rating_id">
                    <option value="0">All</option>
                    <?php foreach($ratings as $rating) : ?>
                        <option value="<?php echo $rating->id ?>"><?php echo $rating->rating_name ?></option>
                    <?php endforeach ?>
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