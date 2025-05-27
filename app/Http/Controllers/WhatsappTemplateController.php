<?php

namespace App\Http\Controllers;

use App\Jobs\WhatsappMetaJob;
use App\Models\WhatsappTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class WhatsappTemplateController extends Controller
{
    public function index()
    {
        $templates = WhatsappTemplate::all();
        $language = [1 => 'English', 2 => 'Urdu', 3 => 'Arabic'];
        return view('whatsapp-template.index', compact('templates','language'));
    }
    public function create(){

        return view('whatsapp-template.create');
    }
    public function store(Request $request){

        // $request->validate([
        //     'template_name' => 'required|string|max:255',
        //     'language' => 'required|string|max:255',
        //     'category' => 'required|string|max:255'
        // ]);
        $name = '';
        if (!empty($request->broadcast_media) && !is_null($request->broadcast_media)) {
            $qfile = $request->broadcast_media;
            // dd($qfile);
            $name = time() . '_' . uniqid() . '.' . $qfile->getClientOriginalExtension();
            // if (File::exists(public_path('BroadcastMedia/' . $name))) {

            //     unlink(public_path('BroadcastMedia/' . $name));
            // }
            $type = $qfile->getClientOriginalExtension();
            $size = $qfile->getSize();
            $path = $qfile->move(public_path() . 'BroadcastMedia/', $name);
        }
        // dd($request->cta_type,$request->input('cta_type'));
        $res = WhatsappTemplate::create([
            'template_name' => $request->input('template_name'),
            'language' => $request->input('language'),
            'category' => $request->input('category'),
            'broadcast_type' => $request->input('broadcast_type'),
            'broadcast_description' => $request->input('broadcast_description'),
            'broadcast_media' => $name,
            'broadcast_media_url' => $request->input('broadcast_media_url'),
            'footer_text' => $request->input('footer_text'),
            'body_text' => $request->input('body_text'),
            'template_button' => $request->input('template_button', 0),
            'cta_type' => empty($request->input('cta_type')) ? 0 : $request->input('cta_type'),
            'phone_number' => $request->input('phone_number'),
            'phone_number_description' => $request->input('phone_number_description'),
            'website_description' => $request->input('website_description'),
            'website_url' => $request->input('website_url'),
            'website_type' => $request->input('website_type'),
            'quick_reply_text' => $request->input('quick_reply_text')
        ]);

         // Redirect or return a response
        $this->callWhatsappApis($res);
        return redirect()->route('whatsappTemplate.create')->with('success', 'Template created successfully!');
    }

    public function show($id)
    {
        $template = WhatsappTemplate::find($id);
        $template_button = $template->template_button;
        $cta_type = $template->cta_type;
        return view('whatsapp-template.show', compact('template','template_button','cta_type'));
    }

    public function callWhatsappApis($res){


        dispatch(new WhatsappMetaJob($res));
        // $response = Http::post('http://127.0.0.1:8000/api/webhook/whatsapp');
        // dd($response);


    }
}
