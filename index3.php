<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BeatyKyiv</title>

<link rel="stylesheet" type="text/css" href="default3.css" />

</head>

<body>

<div id="page">

    <div class="block rounded">
        <h1>Create an ad "MANICURE- PEDICURE"</h1>
    </div>
    
    <div class="block_main rounded">
        <h2>Notice Board</h2>
        
        <form method="post" action="shout3.php">
            Your name: <input type="text" id="name" name="name" />
            Message: <input type="text" id="message" name="message" class="message" /><input type="submit" id="submit" value="Submit" />
        </form>
        
        <div id="shout">
            
        </div>
    </div>
</div>

<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script type="text/javascript">
$(function() {
    refresh_shoutbox();
    setInterval("refresh_shoutbox()", 15000);

    $("#submit").click(function() {
        var name    = $("#name").val();
        var message = $("#message").val();
        var data            = 'name='+ name +'&message='+ message;

        $.ajax({
            type: "POST",
            url: "shout3.php",
            data: data,
            success: function(html){
                $("#shout").slideToggle(500, function(){
                    $(this).html(html).slideToggle(500);
                    $("#message").val("");
                });
          }
        });    
        return false;
    });
});

function refresh_shoutbox() {
    var data = 'refresh=1';
    
    $.ajax({
            type: "POST",
            url: "shout3.php",
            data: data,
            success: function(html){
                $("#shout").html(html);
            }
        });
}


</script>
</body>
</html>