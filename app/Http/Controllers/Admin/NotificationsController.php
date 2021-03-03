<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Category;
use App\CategoryFollow;
use App\Classes\FCM;
use App\Country;
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
            'countries' => Country::where('is_active', 1)->get(),
//            'categories' => Category::where('parent_id', 0)->get(),
        ]);
    }

    public function send()
    {

        $data = request()->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'action' => 'nullable|in:account,collection,general',
            'action_id' => 'required_if:action,account,collection',
            'country_id' => 'required|exists:countries,id',
        ]);

        if (request()->filled('action')) {
            $data['action'] = request()->get('action');
            $data['action_id'] = request()->get('action_id');
        }

        $data['category_id'] = request()->has('followers_collection') ? request()->get('followers_collection') : 0;

        $all = request()->get('followers_collection');


        if (!isset($all) && request()->has('action') && request()->get('action') == 'general') {

            $data['is_all'] = 1;
            $notification = Notification::create($data);

//            foreach ($receivers as $receiver) {
//                NotificationReceiver::create(['notification_id' => $notification->id, 'receiver_id' => $receiver]);
//                (new FCM())->sendNotification($receiver, request()->get('title'), $notification);
//            }


            $notification = Notification::find($notification->id);

//            (new FCM())->FCMTopic(request('title'), request('content'), $notification);
            (new FCM())->send(request('title'), request('content'), $notification);
//            (new FCM())->send(request('title'), request('content'));
//            Notification::create($data);
        } else {


            if (request()->filled('followers_collection')) // send notification to specific users
            {

                $receivers = CategoryFollow::whereHas('User', function ($query) use ($data) {
                    $query->where('country_id', $data['country_id']);
                })->where('category_id', request()->get('followers_collection'))->pluck('user_id')->unique();
                $data['category_id'] = request()->get('followers_collection');

            } else

                $receivers = CategoryFollow::whereHas('User', function ($query) use ($data) {
                    $query->where('country_id', $data['country_id']);
                })->pluck('user_id')->unique();


            $notification = Notification::create($data);
            $notification = Notification::find($notification->id);

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

    public function getItems($country_id, $type = null, $follow_collection = null)
    {
        $options = '';

        if ($type == 'account') {

            if (isset($follow_collection)) {
//                $followers = ::where('category_id', $follow_collection)->pluck('user_id')->unique();
                $accounts = Account::whereHas('categories', function ($q) use ($follow_collection) {
                    $q->where('category_id', $follow_collection);
                })->where('country_id', $country_id)->where('status', 1)->published()->get();
            } else
                $accounts = Account::where('country_id', $country_id)->where('status', 1)->published()->get();

            foreach ($accounts as $account) {
                $options .= '<option value="' . $account->id . '">' . $account->description . '</option>';
            }
        }
        if ($type == 'collection') {
            $categories = Category::whereHas('countries', function ($query) use ($country_id) {
                $query->where('country_id', $country_id);
            })->where('parent_id', 0)->where('status', 1)->get();

            foreach ($categories as $category) {
                $options .= '<option value="' . $category->id . '">' . $category->name . '</option>';
            }
        }

        return $options;
    }

    public function getCategoriesByCountry($country_id)
    {
        $options = '<option value="">' . __('inputs.all') . '</option>';

        $categories = Category::whereHas('countries', function ($query) use ($country_id) {
            $query->where('country_id', $country_id);
        })->where('parent_id', 0)->where('status', 1)->get();

        foreach ($categories as $category) {
            $options .= '<option value="' . $category->id . '">' . $category->name . '</option>';
        }


        return $options;
    }


}
