<script>
    function shout() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.status == 200) {
                document.getElementById("body").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "getResults.php");
        xmlhttp.send();
    }

    setInterval(() => {
        shout()
    }, 10);
</script>

<div id="body">

</div>