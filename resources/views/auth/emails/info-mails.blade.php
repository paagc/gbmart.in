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

<table>
    <tr>
        <td>{{$mail->body}}</td>
    </tr>
</table>


<table>
    <?php $signature = explode("--", $mail->signature) ?>
    @foreach($signature as $item)
        <tr>
            <td>{{$item}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>