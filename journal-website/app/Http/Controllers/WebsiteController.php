<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return redirect()->to(url('dev'));

        return view('website.vue-web-home');
    }

    public function test()
    {

        // $client = new Client();
        // $crawler = $client->request('GET', 'https: //fbcci.org/about-fbcci/');
        // $crawler->filter('p')->each(function ($node) {
        //     echo $node->text()."\n";
        // });
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $localPaths = cloudflare(file: $image, folder: 'radal', resizeSize: '200x200,400x400', base64: false);

            return $localPaths;
        }

        return 'Die;';
    }
}
