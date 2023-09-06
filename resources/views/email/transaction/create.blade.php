@extends('email.layout')
@section('email_title')
    <strong style="text-transform: uppercase">
        Transaction Created
    </strong>
@endsection
@section('custom_css')
    <style>
        .table{
            padding: 40px;
            background:#fff;
            width:100%
        }
        .table tr td,.table tr th {
            border:1px solid #ddd;
            text-align: center;
            padding: 10px;
        }
    </style>
@endsection
@section('email_content')
<table class="table table-borderless" style="">
    <tr>
        <th colspan="2">
            TRANSACTION DETAILS
        </th>
    </tr>
    <tr>
        <td>
            Investor Name:
        </td>
        <td>
            {{  $data['investor'] }}
        </td>
    </tr>

    <tr>
        <td>
            Investment Amount:
        </td>
        <td>
            ${{  $data['investment_amount'] }}
        </td>
    </tr>
    <tr>
        <td>
            Type of Security:
        </td>
        <td>
            {{  $data['type_of_security'] }}
        </td>
    </tr>


    <tr>
        <td>
            Share Price:
        </td>
        <td>
            {{  $data['share_price'] }}
        </td>
    </tr>


    <tr>
        <td>
            Share Count:
        </td>
        <td>
            {{  $data['share_count'] }}
        </td>
    </tr>

    <tr>
        <td>
            Shares Sold to Date:
        </td>
        <td>
            {{  $data['share_sold_date'] }}
        </td>
    </tr>
    <tr>
        <td>
            Total Raised:
        </td>
        <td>
            {{  $data['total_raised'] }}
        </td>
    </tr>
</table>
    <p style=" background:#fff; padding:20px;">
        Currently    {{  $data['offer_name'] }}  has raised   {{  $data['size'] }}   in completed investments. <br />

        Please note that you may cancel your investment up to 48 hours before the end date of the campaign,
        <b style="color:rgb(161, 16, 16)"> {{  $data['funding_end_date'] }}</b> . <br>

        Transcation Link ..
        <br>
        Thank you! <br>
        The {{  env('APP_NAME') }} Team
    </p>

@endsection
