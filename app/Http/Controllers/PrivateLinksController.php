<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Handlers\FormHandler;
use App\Models\Links\PrivateLink;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class PrivateLinksController extends Controller
{

    public function index() {
        $links = PrivateLink::orderBy('client')->get();
        if($links->count() == 0) {
            Session::flash('warning', "You currently don't have any links saved! Create one now!");
            return redirect()->route('admin.links.create');
        }
        return view('admin.links.index')
                    ->withLinks($links);
    }

    public function create() {
        return view('admin.links.create');
    }

    public function store(Request $request) {
        $request = FormHandler::clean($request);
        $link = new PrivateLink;
        $link->client = $request->client;
        $link->link = $request->link;
        $link->uuid = Str::uuid()->toString();
        $link->save();
        Session::flash('success', 'You have saved the link successfully!');
        return redirect()->route('admin.links.index');
    }

    public function edit($uuid) {
        $link = PrivateLink::where('uuid', $uuid)->first();
        if($link == null) {
            Session::flash('warning', 'This link does not exist!');
            return redirect()->route('admin.links.index');
        }
        return view('admin.links.edit')
                    ->withLink($link);
    }

    public function update(Request $request, $uuid) {
        $link = PrivateLink::where('uuid', $uuid)->first();
        if($link == null) {
            Session::flash('warning', 'This link does not exist!');
            return redirect()->route('admin.links.index');
        }
        $request = FormHandler::clean($request);
        $link->client = $request->client;
        $link->link = $request->link;
        $link->uuid = Str::uuid()->toString();
        $link->save();
        Session::flash('success', 'You have saved the link successfully!');
        return redirect()->route('admin.links.index');
    }

    public function delete($uuid) {
        $link = PrivateLink::where('uuid', $uuid)->first();
        if($link == null) {
            Session::flash('warning', 'This link does not exist!');
            return redirect()->route('admin.links.index');
        }
        $link->delete();
        Session::flash('success', 'You have deleted the link successfully!');
        return redirect()->route('admin.links.index');
    }

    public function clientLink($uuid) {
        $link = PrivateLink::where('uuid', $uuid)->first();
        if($link == null) {
            Session::flash('warning', "This link is not valid. Please contact us to get a new link!");
            return redirect()->route('index');
        }
        return Redirect::to($link->link);
    }
}
