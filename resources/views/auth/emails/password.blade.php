<style>
    br {
        display: none;
    }
</style>

Click here to reset your password:

<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($email) }}"> {{ $link }} </a>
<br>
GBMart.in