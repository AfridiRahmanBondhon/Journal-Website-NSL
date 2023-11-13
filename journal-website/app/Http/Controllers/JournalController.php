<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Website\Content\Content;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\Website\Content\ContentFile;

class JournalController extends Controller
{
    public function index()
    {
        return view('journal.journal-web-home');
    }
    public function content()
    {
        return view('journal.content.content',[
            'content'=>Content::first(),
            'contentFiles'=>ContentFile::all(),
        ]);
    }
    public function feature()
    {
        return view('journal.feature.feature');
    }
    public function faq()
    {

        return view('journal.faq.faq',[
            'faqs'=> Faq::all(),
        ]);
    }
    public function contactUs()
    {
        return view('journal.contactUs.contact-us');
    }
    public function orderForm()
    {
        return view('journal.orderForm.order-form');
    }


    public function newsLetter(Request $request){
        //dd('hi');
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|max:191',
        ]);
        if ($validator->fails()){
            $data=[
                'status'=>202,
                'error'=>$validator->messages(),
            ];
            return response()->json($data,202);
        }else{
            $s=Subscription::create([
                'email'=>$request->email,
            ]);
            Alert::success('Subscribed Successfully','Welcome to our community!');
        }
        return back()->with('success', 'Subscribed Successfully'); //redirect(route('home'))->withSuccess('Task Created Successfully!');
    }
}
