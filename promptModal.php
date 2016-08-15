<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>
<?php $scores=$_REQUEST[ "scores"]; ?>
<body>
    <span>Game Over!</span>
    <br>
    <br>
    <span class="enter">Enter your name:</span>
    <br>
    <input name="name" class="form-control" type="text"></input>
    <br>
    <br>
    <input name="scores" type="hidden" value="<?php echo $scores;?>"></input>
    <div class='btn-group'>
        <button class="btn btn-primary btn-md" type="button" onclick="SendToDB()" value="Submit">Submit</button>
        </button>
    </div>
</body>
</html>