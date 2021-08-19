<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::all();

        return view('form', [
            'links' => $links,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = $request->input('url');
        $link = Link::create([
            'url' => preg_match('~https?://~', $url) ? $url : '//' . $url,
            'clicks_limit' => $request->input('clicks_limit'),
            'expired_at' => date("Y-m-d H:i:s", strtotime("+" . $request->input('expired_at') . " hours")),
            'token' => Str::random(8),
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $link = Link::find($token);

        if (strtotime($link->expired_at) > time()) {
            if ($link->clicks_limit > 1) {
                $link->clicks_limit -= 1;
                $link->save();
            } elseif ($link->clicks_limit == 1) {
                $link->clicks_limit = -1;
                $link->save();
            } elseif ($link->clicks_limit == -1) {
                return view('404');
            }

            return redirect($link->url);
        }
        return view('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
