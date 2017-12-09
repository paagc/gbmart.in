<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
        br{
            display: none;
        }
    </style>
</head>
<body>
<h2>A contact request from - {{$form['name']}}</h2>
name: {{$form['name']}}
phone: {{$form['phone']}}
email: {{$form['email']}}
subject: {{$form['subject']}}
message: {{$form['message']}}

</body>
</html>
