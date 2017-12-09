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
<h2>Verify Your Email Address</h2>
<?php if (isset($userToUpdate)) $user = $userToUpdate; ?>
<h4>Dear {{$user->title}}{{$user->first_name}} {{$user->last_name}},</h4>
<table>
    <tr>
        <td>{{$mail->body}}</td>
    </tr>
</table>

    <a href="{{ url('auth/confirm-email?token=' . $user->email_confirmation_code . '&email='.$user->email) }}">{{ url('auth/confirm-email?token=' . $user->email_confirmation_code . '&email='.$user->email.'&user-type=new') }}</a>.
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
