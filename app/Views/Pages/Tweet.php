<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo(app)?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">

    <link rel="stylesheet" href="css/font-awesome.min.css" />  
        <link rel="stylesheet" href="css/bootstrap.min.css" />       
  
</head>

<body>
    <main class='main'>
        <h1 class="light"><i class="fab fa-twitter-square"></i> Twitter</h1>
        <div class="container" id="container">


            <form class="input-box">

                <div class="tweet-Box">
                    <textarea class="text-area" name="new-tweet" id="text-area"  placeholder=" Insert Your Tweet"
                        cols="182" rows="5"></textarea>
                    <div class="line" id="line">
                        <i class="fas fa-camera"></i>
                        <i class="fas fa-map-marker-alt"></i>
                     <!--   <button class="btn btn-info" onclick="show_All_tweets(event)" id="show" type="submit" >Show Tweets</button>  -->
                        <button class="btn btn-info"  onclick="createTweet(event)"  id="create" type="submit"  >Create Tweet</button>
                    </div>
                </div>
            </form>

        </div>


        <div class="tweet-list row" id="list">
                
        </div>
        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="/script.js?version=1"></script>

</body>

</html>



