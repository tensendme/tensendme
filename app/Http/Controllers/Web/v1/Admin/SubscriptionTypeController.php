<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\SubscriptionTypeControllerRequests\SubscriptionTypeRequest;
use App\Models\Subscriptions\SubscriptionType;

class SubscriptionTypeController extends WebBaseController
{
    public function index()
    {
        $subscription_types = SubscriptionType::where('price', '!=', 0)->get();

        return view('admin.subscriptionTypes.index', compact('subscription_types'));
    }

    public function create()
    {

        $subscription_type = new SubscriptionType();

        return view('admin.subscriptionTypes.create', compact('subscription_type'));
    }

    public function store(SubscriptionTypeRequest $request)
    {

        SubscriptionType::create($request->all());
        $this->added();

        return redirect()->route('subscription.type.index');

    }

    public function edit($id)
    {

        $subscription_type = SubscriptionType::findOrFail($id);

        return view('admin.subscriptionTypes.edit', compact('subscription_type'));

    }

    public function update(SubscriptionTypeRequest $request, $id)
    {
        SubscriptionType::findOrFail($id)
            ->update($request->all());
        $this->edited();
        return redirect()->route('subscription.type.index');

    }

    public function destroy($id)
    {
        SubscriptionType::destroy($id);

        $this->deleted();

        return redirect()->route('subscription.type.index');
    }


    public function visibleChange($id)
    {
        $subscriptionType = SubscriptionType::findOrFail($id);
        $subscriptionType->is_visible = !$subscriptionType->is_visible;
        $subscriptionType->save();
        $this->edited();
        return redirect()->back();
    }
}
