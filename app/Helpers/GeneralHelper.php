<?php

use App\Models\Coin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

function showDateTime($datetime)
{
    if (!validateDateFormat($datetime)) {
        return '';
    }

    return Carbon::parse($datetime)->format('d-M-Y H:i:s');
}

function showDate($datetime)
{
    if (!validateDateFormat($datetime)) {
        return '';
    }

    return Carbon::parse($datetime)->format('d-M-Y');
}

function is_active_menu($link)
{
    return (request()->is($link)) ? 'active' : '';
}

function validateDateFormat($date,$format='')
{
    $is_valid_date = false;
    if(!empty($date)){
        if(!empty($format)){
            $dt = DateTime::createFromFormat($format, $date);
            $is_valid_date = $dt !== false && !array_sum($dt->getLastErrors());
        }
        else{
            $timestamp = !is_numeric($date) ? strtotime($date) : $date;
            if(date("Y", $timestamp) > 1970) $is_valid_date = true;
        }
    }

    return $is_valid_date;
}

function statusBadge($status)
{
    $color = "secondary";
    switch ($status) {
        case "pending":
        case "sell":
            $color = "primary";
            break;
        case "active":
        case "approved":
            $color = "success";
            break;
        case "disabled":
        case "rejected":
            $color = "danger";
            break;
        case "buy":
            $color = "dark";
            break;
        default:
            break;
    }

    return '<span class="badge badge-'.$color.' p-1 text-capitalize">'.$status.'</span>';
}

function statusDropdown($entity, $status, $id) {
    $list = [];
    switch ($entity) {
        case "withdrawal":
        case "deposit":
            $list = ["pending", "approved", "rejected"];
            break;
        case "payment_method":
            $list = ["active", "disabled"];
            break;
        default:
            break;
    }

    $html = '<select class="form-control btn-status" name="status" id="status-'.$id.'" data-id="'.$id.'">';
    foreach ($list as $item) {
        $selected = ($item == $status) ? "selected" : '';
        $html .= '<option value="'.$item.'" '.$selected.'>'.$item.'</option>';
    }
    $html .= '</select>';

    return $html;
}

function getCoins($first = false) {
    if ($first)    return Coin::first();

    return Coin::all();
}

/**
 * @param $to
 * @param $subject
 * @param $data
 * @param $blade
 * @return bool
 */
function send_email($to, $subject, $data, $blade)
{
    $sent = true;
    try {
        Mail::send(sprintf('mails.%s', $blade), $data, function ($message) use ($to, $subject) {
            $message->to($to)
                ->subject($subject);
            $message->from(
                env('MAIL_FROM_ADDRESS', 'haidersyed106@gmail.com'),
                env('APP_NAME', 'Easy Option')
            );
        });
    } catch (\Exception $e) {
        $sent = false;
    }

    return $sent;
}
