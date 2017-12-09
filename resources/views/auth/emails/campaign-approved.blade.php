<h4>Dear {{$campaign->user->title}}{{$campaign->user->first_name}} {{$campaign->user->last_name}},</h4>

<table>
    <tr>
        <td>{{$mail->body}}</td>
    </tr>
</table>

    The MOU will be connected to you by {{$campaign->manager->first_name}}


<style>
    table, thead, tr {
        border: 1px solid #2e3436;
    }
    br{
        display: none;
    }
</style>
<table style=" border: 1px solid #2e3436; margin-bottom: 25px;">
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
        Card Rate
    </th>
    <th style=" border: 1px solid #2e3436;">
        Closing Rate
    </th>
    </thead>
    <tbody>
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
                {{round($detail->asset->price+0)}}
            </td>
            <td style=" border: 1px solid #2e3436;">
                {{round($detail->invoice_price+0)}}
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

