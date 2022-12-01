<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>We are voting</h1>
    
    <form action="process.php" method="POST">
        <select name="color">
            <option>Red</option>
            <option>Blue</option>
            <option>Yellow</option>
        </select>
        <button name="amvoting"> Vote </button>
    </form>

    <button onclick="shout()">
        Shida
    </button>

    <div id="polldata">
    </div>

</body>
<script>
    function shout(){
        var xmlhttp= new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
            if (this.status==200) {
                document.getElementById("polldata").innerHTML = this.responseText;
            }
        }

        xmlhttp.open("GET","getPollingProgress.php");
        xmlhttp.send();
    }

    setInterval(() => {
        shout()
    }, 10);
</script>
</html>