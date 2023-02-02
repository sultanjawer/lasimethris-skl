<?php

namespace App\Http\Controllers\Admin;

use App\Models\Berkas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PullRiph;
use Gate;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use PhpParser\ErrorHandler\Collecting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DateTime;
use DateTimeZone;
use PhpParser\Node\Expr\Cast\Array_;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexberkas()
    {
        abort_if(Gate::denies('berkas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $realnpwp = Auth::user()::find(Auth::user()->id)->data_user->npwp_company;
        $pullRiph = PullRiph::where('npwp', $realnpwp)->first();
        $dataUser = Auth::user()::find(Auth::user()->id)->data_user;
        
        $npwp = str_replace('.', '', $realnpwp);
        $npwp = str_replace('-', '', $npwp);

        $data_berkas = new Collection(); 
        $item = [];
        if ($pullRiph->formRiph !== null){
            $item += array('berkas' => 'Form-RIPH');
            $item += array('filename' => basename($pullRiph->formRiph));
            $exists = Storage::disk('public')->exists($pullRiph->formRiph);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->formRiph);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            $item += array('fullpath' => '/'.$pullRiph->formRiph);
            $data_berkas->push($item);
        }
        
        $item = [];
        if ($pullRiph->formSptjm !== null){
            $item += array('berkas' => 'Form-SPTJM');
            $item += array('filename' => basename($pullRiph->formSptjm));
            $exists = Storage::disk('public')->exists($pullRiph->formSptjm);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->formSptjm);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$pullRiph->formSptjm);
            $data_berkas->push($item);
        }


        $item = [];
        if ($pullRiph->formRt !== null){
            $item += array('berkas' => 'Form-RT');
            $item += array('filename' => basename($pullRiph->formRt));
            $exists = Storage::disk('public')->exists($pullRiph->formRt);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->formRt);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$pullRiph->formRt);
            $data_berkas->push($item);
        }

        $item = [];
        if ($pullRiph->formRta !== null){
            $item += array('berkas' => 'Form-RTA');
            $item += array('filename' => basename($pullRiph->formRta));
            $exists = Storage::disk('public')->exists($pullRiph->formRta);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->formRta);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$pullRiph->formRta);
            $data_berkas->push($item);
        }

        $item = [];
        if ($pullRiph->formRpo !== null){
            $item += array('berkas' => 'Form-RPO');
            $item += array('filename' => basename($pullRiph->formRpo));
            $exists = Storage::disk('public')->exists($pullRiph->formRpo);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->formRpo);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$pullRiph->formRpo);
            $data_berkas->push($item);
        }

        $item = [];
        if ($pullRiph->formLa !== null){
            $item += array('berkas' => 'Form-La');
            $item += array('filename' => basename($pullRiph->formLa));
            $exists = Storage::disk('public')->exists($pullRiph->formLa);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->formLa);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$pullRiph->formLa);
            $data_berkas->push($item);
        }
        
        $item = [];
        if ($pullRiph->logBook !== null){
            $item += array('berkas' => 'Log Book');
            $item += array('filename' => basename($pullRiph->logBook));
            $exists = Storage::disk('public')->exists($pullRiph->logBook);
            if ($exists) {
                $time = Storage::disk('public')->lastModified($pullRiph->logBook);  
                $time = DateTime::createFromFormat("U", $time);  
                $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
                $item += array('date_updated' => $time->format('d/m/Y H:i:s'));
            }
            
            $item += array('fullpath' => '/'.$pullRiph->logBook);
            $data_berkas->push($item);
        }

        $module_name = 'User task' ;
        $page_title = 'Berkas Saya';
        $page_heading = 'Berkas Saya' ;
        $heading_class = 'fa fa-file';
        return view('admin.folder.indexberkas', compact('module_name', 'page_title', 'page_heading', 'heading_class', 'data_berkas',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    'npwp'));
    
    }

    public function indexgaleri()
    {
        abort_if(Gate::denies('galeri_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $module_name = 'User task' ;
        $page_title = 'Galeri Saya';
        $page_heading = 'Galeri Saya' ;
        $heading_class = 'fa fa-image';
        return view('admin.folder.indexgaleri', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
    
    }

    public function indextemplate()
    {
        abort_if(Gate::denies('template_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $module_name = 'User task' ;
        $page_title = 'Template Master';
        $page_heading = 'Template Master' ;
        $heading_class = 'fa fa-heart';
        return view('admin.folder.indextemplate', compact('module_name', 'page_title', 'page_heading', 'heading_class'));
    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function show(Berkas $berkas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function edit(Berkas $berkas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berkas $berkas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berkas  $berkas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berkas $berkas)
    {
        //
    }
}
