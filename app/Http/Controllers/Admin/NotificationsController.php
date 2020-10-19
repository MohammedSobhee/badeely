<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\CategoryFollow;
use App\Classes\FCM;
use App\Http\Controllers\Controller;
use App\Notification;
use App\User;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->paginate(20);
        return view('admin.notifications.index', [
            'notifications' => $notifications,
            'categories' => Category::where('parent_id', 0)->get(),
        ]);
    }

    public function send()
    {
        $data = request()->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $all = request()->get('followers_collection');

        if (!isset($all)) {

            (new FCM())->send(request('title'), request('content'));
            Notification::create($data);
        } else {
            // send notification to specific users
            $receivers = CategoryFollow::where('category_id', request()->get('followers_collection'))->pluck('user_id')->unique();

            foreach ($receivers as $receiver) {
                (new FCM())->sendNotification($receiver, request()->get('title'), request()->get('content'));
            }

            $data['category_id'] = request()->get('followers_collection');
            Notification::create($data);

        }


        return redirect(route('admin.notifications.index'))->with('success', __('dashboard.sent'));
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);
        $notification->delete();

        return back()->with('success', __('dashboard.deleted'));
    }

}
