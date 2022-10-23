<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Weather recommendations</title>
</head>
<body>
      
@yield('content')
 
</body>
<script>
    $("#submit-button").click(function (e) {
        e.preventDefault();
        var city = $("input[name=city]").val();

        $.ajax({
            method: "POST",
            url: "api/products/recommended/" + city,
            success: function (data) {
                var test = JSON.stringify(data);
                alert(test);
            },
            error: function (error) {        
                if (error.responseJSON.exception) {
                 alert('City not found');
                } else {
                    alert(error.responseJSON.error);
                }
            }
        });
    });
</script>
</html>