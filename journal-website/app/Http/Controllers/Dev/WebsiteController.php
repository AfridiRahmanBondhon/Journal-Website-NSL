<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\Events;
use App\Models\Faq;
use App\Models\Website\Content\Content;
use App\Models\Website\Gallery\Album;
use App\Models\Website\Gallery\Photo;
use App\Models\Website\Gallery\Slider;
use App\Models\Website\Gallery\Video;
use App\Models\Website\News;
use App\Models\Website\Notice;
use App\Traits\MailTrait;
use Exception;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    use MailTrait;

    public function index()
    {
        $slider = Slider::query()
            ->with('details')
            ->active()
            ->where('position', 'Header')
            ->first();

        $about = Content::query()
            ->active()
            ->where('slug', 'about-us')
            ->first();

        $events = Events::with('category')->active()->latest()->limit(6)->get();

        $news = News::with('category')->active()->latest()->limit(6)->get();
        $notices = Notice::with('category')->active()->latest()->limit(6)->get();

        $faqs = Faq::active()->latest()->limit(6)->get();

        $photos = Album::where('type', 'photos')->active()->latest()->limit(6)->get();
        $videos = Album::where('type', 'videos')->active()->latest()->limit(6)->get();

        return view('dev.home', [
            'slider' => $slider,
            'about' => $about,
            'events' => $events,
            'news' => $news,
            'notices' => $notices,
            'faqs' => $faqs,
            'photos' => $photos,
            'videos' => $videos,
        ]);
    }

    public function events()
    {
        $events = Events::with('category')->active()->latest()->paginate(12);

        return view('dev.pages.event.index', [
            'events' => $events,
        ]);
    }

    public function eventShow(Request $request)
    {
        $event = Events::where('slug', $request->slug)->firstOrFail();

        return view('dev.pages.event.show', [
            'event' => $event,
        ]);
    }

    public function news()
    {
        $news = News::with('category')->active()->latest()->paginate(12);

        return view('dev.pages.news.index', [
            'news' => $news,
        ]);
    }

    public function newsShow(Request $request)
    {
        $news = News::where('slug', $request->slug)->firstOrFail();

        return view('dev.pages.news.show', [
            'news' => $news,
        ]);
    }

    public function notice()
    {
        $notices = Notice::with('category')->active()->latest()->paginate(12);

        return view('dev.pages.notice.index', [
            'notices' => $notices,
        ]);
    }

    public function noticeShow(Request $request)
    {
        $notice = Notice::where('slug', $request->slug)->firstOrFail();

        return view('dev.pages.notice.show', [
            'notice' => $notice,
        ]);
    }

    public function albums()
    {
        $albums = Album::active()->latest()->paginate(12);

        return view('dev.pages.album.index', [
            'albums' => $albums,
        ]);
    }

    public function photos($slug)
    {
        $album = Album::where('type', 'Photos')->where('slug', $slug)->firstOrFail();
        $photos = Photo::where('album_id', $album->id)->active()->paginate(10);

        return view('dev.pages.photo.index', [
            'photos' => $photos,
            'album' => $album,
        ]);
    }

    public function videos($slug)
    {
        $album = Album::where('type', 'Videos')->where('slug', $slug)->firstOrFail();
        $videos = Video::where('album_id', $album->id)->active()->paginate(12);

        return view('dev.pages.video.index', [
            'videos' => $videos,
            'album' => $album,
        ]);
    }

    public function content(Request $request)
    {
        $content = Content::active()->where('slug', $request->slug)->firstOrFail();

        return view('dev.pages.content.show', [
            'content' => $content,
        ]);
    }

    public function contactStore(Request $request)
    {
        try {

            // Google Captcha
            request()->validate([
                'g-recaptcha-response' => 'required|captcha',
            ]);

            $data = $request->all();
            $contact_name = $request->name;
            $contact_email = $request->email;
            $contact_sub = $request->subject;
            $contact_body = $request->message;
            $this->contactMail($contact_email, $contact_name, $contact_sub, $contact_body);
            $res = Contacts::create($data);

            return $this->responseReturn('create', $res);
        } catch (Exception $ex) {
            return response()->json(['exception' => $ex->errorInfo ?? $ex->getMessage()], 422);
        }
    }
}
