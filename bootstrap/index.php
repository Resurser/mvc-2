<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Javascript</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .red {
            color: red;
        }
    </style>

</head>
<body>



<div class="container">
    <h2>jQuery selectors</h2>
    <hr>
    <p id="one">I am a paragraph with an ID of "one"</p>
    <p id="two">I am a paragraph with an ID of "two"</p>
    <p id="three">I am a paragraph with an ID of "three"</p>
    <hr>
    <input type="text" name="selector" id="selector">
    <a class="btn btn-danger" href="#" onclick="changeClass($('#selector').val())" >
        Click me to change
    </a>
    <a class="btn btn-primary" href="#" onclick="sayHelloWord()">Click me</a>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>



<script>

    function changeClass(x){
        $("#" + x).addClass('red');
    }

    function sayHelloWord(){
        var  myText;
        myText = returnText();
        alert(myText);
    }
    function returnText(){
        return "Hello Word return";
    }
</script>
</body>
</html>