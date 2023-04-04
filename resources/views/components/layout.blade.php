<html>
    <head>
        <title>{{ $title ?  "Laravel Sample - {$title} -" : 'Laravel Sample'  }}</title>
    </head>
    <body>
        {{ $slot }}
    </body>
</html>