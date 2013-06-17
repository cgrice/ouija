<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TESTSUITE_TITLE; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700|Inconsolata:400,700' rel='stylesheet' type='text/css'>
        <style>
            body {
                font-family: 'Lato', 'sans-serif';
            }
            .passes, .passes td {
                background-color: #dff0d8!important;
            }
            .fails, .fails td {
                background-color: #f2dede!important;
            }
            .code {
                font-family: 'Inconsolata', 'monospace';
                background-color: black;
                color: #eee;
            }
            #output { 
                display: none;
            }
        </style>
    </head>
    <body>
