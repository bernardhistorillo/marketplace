<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mustachio extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'description',
        'image',
        'trans_bg',
        'attributes',
        'exists',
    ];

//    protected $casts = [
//        'attributes' => 'array',
//    ];

    /**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }
}
