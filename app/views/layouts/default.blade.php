<!DOCTYPE html>
<html>
  <head>
    <title>Womble 2013</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{{ asset('assets/css/bootstrap.min.css') }}}" rel="stylesheet" media="screen">
    <link href="{{{ asset('assets/css/datepicker.css') }}}" rel="stylesheet" media="screen">
    <link href="{{{ asset('assets/css/womble.min.css') }}}" rel="stylesheet" media="screen">
  </head>
  <body>
    <div class="container primary-container">
      <a href="http://womble.me.uk"><img src="{{{ asset('assets/img/Womble.png') }}}" alt="Womble"></a>

      {{ isset($content) ? $content : '' }}
    </div>
    <script src="http://code.jquery.com/jquery.js" charset="UTF-8"></script>
    <script src="{{{ asset('assets/js/bootstrap.min.js') }}}" charset="UTF-8"></script>
    <script src="{{{ asset('assets/js/bootstrap-datepicker.js') }}}" charset="UTF-8"></script>
  </body>
</html>