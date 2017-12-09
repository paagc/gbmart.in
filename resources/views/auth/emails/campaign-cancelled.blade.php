<style>
    br {
        display: none;
    }
</style>
<h4>Dear {{$campaign->user->title}}{{$campaign->user->first_name}} {{$campaign->user->last_name}},</h4>


<table>
    <tr>
        <td>{{$mail->body}}</td>
    </tr>
</table>

<h4>
    campaign: '{{$campaign->code}}'
</h4>

<table>
    <?php $signature = explode("--", $mail->signature) ?>
    @foreach($signature as $item)
        <tr>
            <td>{{$item}}</td>
        </tr>
    @endforeach
</table>

