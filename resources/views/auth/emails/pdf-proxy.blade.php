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

<table style=" border: 1px solid #2e3436;">
    <thead style=" border: 1px solid #2e3436;">
    <th style=" border: 1px solid #2e3436;">
        Serial No.
    </th>
    <th style=" border: 1px solid #2e3436;">
        Particulars
    </th>
    <th style=" border: 1px solid #2e3436;">
        Site Ref Pic
    </th>
    <th style=" border: 1px solid #2e3436;">
        Card Rate (30Days)
    </th>
    </thead>
    <tbody style=" border: 1px solid #2e3436;">
    @foreach($campaign->details as $index=> $detail)
        <tr style=" border: 1px solid #2e3436;">
            <td style=" border: 1px solid #2e3436;">
                {{$index+1}}
            </td>
            <td style=" border: 1px solid #2e3436;">
                {{$detail->asset->description}}
            </td>
            <td style=" border: 1px solid #2e3436;">
                {{$detail->asset->site->description}}
            </td>
            <td style=" border: 1px solid #2e3436;">
                {{$detail->asset->price}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<table>
    <?php $signature = explode("--", $mail->signature) ?>
    @foreach($signature as $item)
        <tr>
            <td>{{$item}}</td>
        </tr>
    @endforeach
</table>

