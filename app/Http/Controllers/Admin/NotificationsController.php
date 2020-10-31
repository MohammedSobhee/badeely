<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Category;
use App\CategoryFollow;
use App\Classes\FCM;
use App\Http\Controllers\Controller;
use App\Notification;
use App\NotificationReceiver;
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
            'action' => 'nullable|in:account,collection',
            'action_id' => 'required_with:action',
        ]);

        if (request()->has('action')) {
            $data['action'] = request()->get('action');
            $data['action_id'] = request()->get('action_id');
        }
        $all = request()->get('followers_collection');

        if (!isset($all)) {

            $data['is_all'] = 1;
            $notification = Notification::create($data);

//            foreach ($receivers as $receiver) {
//                NotificationReceiver::create(['notification_id' => $notification->id, 'receiver_id' => $receiver]);
//                (new FCM())->sendNotification($receiver, request()->get('title'), $notification);
//            }

            (new FCM())->send(request('title'), request('content'), $notification);
//            (new FCM())->send(request('title'), request('content'));
//            Notification::create($data);
        } else {
            // send notification to specific users
            $receivers = CategoryFollow::where('category_id', request()->get('followers_collection'))->pluck('user_id')->unique();


            $data['category_id'] = request()->get('followers_collection');
            $notification = Notification::create($data);
            foreach ($receivers as $receiver) {
                NotificationReceiver::create(['notification_id' => $notification->id, 'receiver_id' => $receiver]);
                (new FCM())->sendNotification($receiver, request()->get('title'), $notification);
            }

//            $data['category_id'] = request()->get('followers_collection');
//            Notification::create($data);

        }


        return redirect(route('admin.notifications.index'))->with('success', __('dashboard.sent'));
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);
        $notification->delete();

        return back()->with('success', __('dashboard.deleted'));
    }

    public function getItems($type = null)
    {
        $options = '';

        if ($type == 'account') {
            $accounts = Account::published()->get();

            foreach ($accounts as $account) {
                $options .= '<option value="' . $account->id . '">' . $account->name . '</option>';
            }
        }
        if ($type == 'collection') {
            $categories = Category::all();

            foreach ($categories as $category) {
                $options .= '<option value="' . $category->id . '">' . $category->name . '</option>';
            }
        }

        return $options;
    }

}
