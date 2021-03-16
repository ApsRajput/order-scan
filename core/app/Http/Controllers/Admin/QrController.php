<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BasicExtended;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QrController extends Controller
{
    public function qrCode() {
        $data['abe'] = BasicExtended::first();
        return view('admin.qr-code', $data);
    }

    public function generate(Request $request) {
        $color = hex2rgb($request->color);

        \QrCode::size(150)
        ->color($color['red'], $color['green'], $color['blue'])
        ->format('png')
        ->generate($request->url, 'assets/front/img/qrcode.png');

        $bes = BasicExtended::all();
        foreach ($bes as $key => $be) {
            $be->qrcode_url = $request->url;
            $be->qrcode_color = $request->color;
            $be->save();
        }

        Session::flash('success', 'QR code generated successfully!');
        return "success";
    }
}
