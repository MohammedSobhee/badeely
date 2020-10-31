<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Transformer\CategoriesTransformer;
use App\Http\Transformer\NotificationsTransformer;
use App\Notification;
use Illuminate\Http\Request;
use App\Api\Controller;

class NotificationController extends Controller
{
    //

    public function index()
    {
        $notifications = Notification::whereHas('Receivers', function ($query) {
            $query->where('receiver_id', auth()->user()->id);
        })->latest()->paginate(10);

        $data = $this->transformer(new NotificationsTransformer(), $notifications)->collection();

        return $this->success($data)->pagination($notifications);
    }

    public function delete($id)
    {
        $notification = Notification::whereHas('Receivers', function ($query) {
            $query->where('receiver_id', auth()->user()->id);
        })->find($id);

        if (isset($notification) && $notification->delete()) {
            return $this->success()->custom('notification_has_been_removed');
        }

        return $this->error()->validation('bad_request');

    }
}
