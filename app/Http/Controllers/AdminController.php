<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Nullable;
use Illuminate\Http\RedirectResponse;
use \App\robot;
use ZipArchive;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // function __construct(){
    //     $this->middleware('role:superadministrator');
    // }

    function index(){
        return view('admin.admin');
    }

    function kategorie(){
        return view('admin.kategoria');
    }


    function showAll(Request $request){
        $osie = \App\osie::all();
        $producent = \App\producent::all();
        $przeznaczenie = \App\przeznaczenie::all();
        $stanowisko = \App\stanowisko::all();
        $kontroler = \App\kontroler::all();
        $stan_techniczny = \App\stan_techniczny::all();

        $robots = \App\robot::all();
        $users = \App\User::all();

        $zapNiez = \App\zapNiezal::all();
        $zapNiezRob = \App\zapRobotNiezal::all();

        $formularze = \App\formularz::all();
        $zdj_formularza = \App\zdjecia_formularza::all();
        $f_formularza = \App\f_formularza::all();

        return view('admin.showAll', compact('robots', 'users', 'osie',
        'producent', 'przeznaczenie', 'stanowisko', 'kontroler', 'stan_techniczny', 'formularze',
        'zapNiez', 'zapNiezRob', 'zdj_formularza', 'f_formularza'));
    }
    
    function editPages(){
        return view('admin.editSites');
    }
    
    function onas(){
        $onas = \App\onas::all();
        foreach($onas as $of) {
            $onas = $of;
            break;
        }
        return view('admin.zmienOnas', compact('onas'));
    }

    function changeonas(\App\onas $onas){
        $data = request()->validate([
            'gora'=>'required',
            'text'=>'required',
            'przejdz'=>'required',
            'zobacz'=>'required',
        ]);

        $onas->update($data);

        return redirect()->back();
    }

    function glowna(){
        $glowna = \App\oferta::all();
        foreach($glowna as $of) {
            $glowna = $of;
            break;
        }
        return view('admin.zmienOferta', compact('glowna'));
    }

    function changeoferta(\App\oferta $oferta){
        $data = request()->validate([
            'gora'=>'required',
            'text'=>'required',
            'porada'=>'required',
            'telefon'=>'required',
        ]);

        $oferta->update($data);

        return redirect()->back();
    }

    function skup(){
        $skup = \App\skup::all();
        foreach($skup as $of) {
            $sk = $of;
            break;
        }
        return view('admin.zmienSkup', compact('sk'));
    }

    function changeskup(\App\skup $skup){
        $data = request()->validate([
            'gora'=>'required',
            'text'=>'required',
            'pobierz'=>'required',
            'wyslij'=>'required',
            'gwiazdka'=>'required'
        ]);

        $skup->update($data);

        return redirect()->back();
    }

    function programowaie(){
        $programowanie = \App\programowanie::all();
        foreach($programowanie as $of) {
            $prog = $of;
            break;
        }
        return view('admin.zmienProgramowanie', compact('prog'));
    }

    function changeprogramowanie(\App\programowanie $programowanie){
        $data = request()->validate([
            'gora'=>'required',
            'text'=>'required'
        ]);

        $programowanie->update($data);

        return redirect()->back();
    }

    function kontakt(){
        $kontakt = \App\kontakt::all();
        foreach($kontakt as $of) {
            $kon = $of;
            break;
        }
        return view('admin.zmienKontakt', compact('kon'));
    }

    function changekontakt(\App\kontakt $kontakt){
        $data = request()->validate([
            'gora'=>'required',
            'text1'=>'required',
            'text2'=>'required'
        ]);

        $kontakt->update($data);

        return redirect()->back();
    }

    function finansowanie(){
        $finansowanie = \App\finansowanie::all();
        foreach($finansowanie as $of) {
            $fin = $of;
            break;
        }
        return view('admin.zmienFinansowanie', compact('fin'));
    }

    function changefinansowanie(\App\finansowanie $finansowanie){
        $data = request()->validate([
            'gora'=>'required',
            'text1'=>'required',
            'text2'=>'required',
            'pytanie'=>'required'
        ]);

        $finansowanie->update($data);

        return redirect()->back();
    }

    function baner(){
        $baner = \App\baner::all();
        foreach($baner as $of) {
            $ban = $of;
            break;
        }
        return view('admin.zmienWspolne', compact('ban'));
    }

    function changebaner(\App\baner $baner){
        $data = request()->validate([
            'pytanie'=>'required',
            'napisz'=>'required',
            'przejdz'=>'required',
        ]);

        $baner->update($data);

        return redirect()->back();
    }

    function download($formularz){
        $form_pictures = \App\zdjecia_formularza::all();
        $arr = array();
        foreach($form_pictures as $form){
            if($form->formularz_id == $formularz){
                array_push($arr, $form);
            }
        }
        $zip = new \ZipArchive();
        $zipname = 'id_' . $formularz . '_images.zip';
        if($zip->open(public_path($zipname), \ZipArchive::CREATE) === true){
            $files = File::files(public_path('images'));
            foreach($files as $key => $value) {
                $name = basename($value);
                foreach ($arr as $ar) {
                    if ($ar->images == $name) {
                        $zip->addFile($value, $name);
                        break;
                    }
                }
            }
        }
        $zip->close();
        return response()->download(public_path($zipname));
    }

    function zdjeciaRobota($robotID, Request $request){
        $robots = \App\robot::all();
        $images = \App\image::all();

        $rob = \App\robot::where('id', $request->query('id', $robotID))->get();

        $robotImages = \App\image::where('robot_id', $request->query('robot_id', $rob[0]['id']))->get();

        return view('admin.zdjeciaRobota', compact('robotImages', 'rob'));
    }


    function kontroler(Request $request): RedirectResponse
    {
        if($request->has('form1')) {
            $data = request()->validate([
                'kontroler' => 'required'
            ]);
            $kontroler = \App\kontroler::create($data);
        }
        return redirect()->back();
    }

    function stanowisko(Request $request): RedirectResponse
    {
        if($request->has('form2')) {
            $data = request()->validate([
                'stanowisko' => 'required'
            ]);
            $kontroler = \App\stanowisko::create($data);
        }
        return redirect()->back();
    }

    function przeznaczenie(Request $request): RedirectResponse
    {
        if($request->has('form3')) {
            $data = request()->validate([
                'przeznaczenie' => 'required'
            ]);
            $przeznaczenie = \App\przeznaczenie::create($data);
        }
        return redirect()->back();
    }

    function producent(Request $request): RedirectResponse
    {
        if($request->has('form4')) {
            $data = request()->validate([
                'producent' => 'required'
            ]);
            $producent = \App\producent::create($data);
        }
        return redirect()->back();
    }

    function stan(Request $request): RedirectResponse
    {
        if($request->has('form5')) {
            $data = request()->validate([
                'stan' => 'required'
            ]);
            $stan = \App\stan_techniczny::create($data);
        }
        return redirect()->back();
    }

    function liczba_osi(Request $request): RedirectResponse
    {
        if($request->has('form6')) {
            $data = request()->validate([
                'liczba_osi' => 'required'
            ]);
            $osie = \App\osie::create($data);
        }
        return redirect()->back();
    }

    function robot(){
        $osie = \App\osie::all();
        $producent = \App\producent::all();
        $przeznaczenie = \App\przeznaczenie::all();
        $stanowisko = \App\stanowisko::all();
        $kontroler = \App\kontroler::all();
        $stan_techniczny = \App\stan_techniczny::all();
        return view('admin.robot', compact('osie', 'producent', 'przeznaczenie', 'stanowisko',
            'kontroler', 'stan_techniczny'));
    }

    function robot_create(Request $request): RedirectResponse
    {
        $data = request()->validate([
            'przeznaczenie_id'=>'required',
            'liczba_osi_id'=>'required',
            'producent_id'=>'required',
            'stanowisko_id'=>'required',
            'nazwa'=>'required',
            'osprzęt'=>'nullable',
            'opis'=>'required',
            'wymiary'=>'nullable',
            'telefon'=>'nullable',
            'udzwig'=>'required',
            'zasieg'=>'required',
        ]);
        $robot = \App\robot::create($data);

        if($request->file('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $path = $file->StoreAs('pdf-s', $name);
    
            $robot->pdf = $name;
            $robot->save();
        }
    

        return redirect()->back();
    }

    function image(){
        $roboty = \App\robot::all();
        return view('admin.image', compact('roboty'));
    }

    function create_image(Request $request): RedirectResponse {
        $data = request()->validate([
            'robot_id'=>'required',
        ]);

        $img = \App\image::create($data);

        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $file->StoreAs('images', $name);
    

        $img->image = $name;
        $img->save();

        return redirect()->back();
    }

    function chooseRobot() {
        $roboty = \App\robot::all();
        $images = \App\image::all();
        
        return view('admin.choose_edit', compact('roboty', 'images'));
    }

    function changeRobot($robot, Request $request) {
        $rob = \App\robot::where('id', $request->query('id', $robot))->get();

        $osie = \App\osie::all();
        $producent = \App\producent::all();
        $przeznaczenie = \App\przeznaczenie::all();
        $stanowisko = \App\stanowisko::all();
        $kontroler = \App\kontroler::all();
        $stan_techniczny = \App\stan_techniczny::all();

        return view('admin.edit', compact('rob', 'osie', 'producent', 'przeznaczenie', 'stanowisko',
            'kontroler', 'stan_techniczny'));
    }

    function storeRobot(\App\robot $robot, Request $request) {
        $data = request()->validate([
            'przeznaczenie_id'=>'required',
            'liczba_osi_id'=>'required',
            'producent_id'=>'required',
            'stanowisko_id'=>'required',
            'nazwa'=>'required',
            'osprzęt'=>'nullable',
            'opis'=>'required',
            'wymiary'=>'nullable',
            'telefon'=>'nullable',
            'udzwig'=>'required',
            'zasieg'=>'required',
        ]);

        $robot->update($data);

        return redirect()->back();
    }

    function delete(){
        $rob = \App\robot::all();
        $przeznaczenie = \App\przeznaczenie::all();
        $osie = \App\osie::all();
        $producent = \App\producent::all();
        $stanowisko = \App\stanowisko::all();
        $kontroler = \App\kontroler::all();
        $stan_techniczny = \App\stan_techniczny::all();
        return view('admin.delete', compact('rob', 'osie', 'producent', 'przeznaczenie', 'stanowisko',
            'kontroler', 'stan_techniczny'));
    }

    function deleteRobot(Request $request): RedirectResponse {
        $data = request()->validate([
            'robot'=>'required'
        ]);
        $images = \App\image::all();
        foreach ($images as $image) {
            if((int)$data['robot'] == $image->robot_id)
                $image->delete();
        }
        $rob = \App\robot::where('id', $request->query('id', $data))->delete();
        return redirect()->back();
    }

    function deletePrzeznaczenie(Request $request): RedirectResponse {
        $data = request()->validate([
            'przeznaczenie_id'=>'required'
        ]);
        $robots = \App\robot::all();
        $images = \App\image::all();

        foreach ($robots as $robot){
            if($robot->przeznaczenie_id == (int)$data['przeznaczenie_id']) {
                foreach ($images as $image) {
                    if ($robot->id == $image->robot_id)
                        $image->delete();
                }
                $robot->delete();
            }
        }
        $przeznaczenie = \App\przeznaczenie::where('id', $request->query('id', $data))->delete();
        return redirect()->back();
    }

    function deleteOsie(Request $request): RedirectResponse {
        $data = request()->validate([
            'liczba_osi_id'=>'required'
        ]);
        $robots = \App\robot::all();
        $images = \App\image::all();

        foreach ($robots as $robot){
            if($robot->liczba_osi_id == (int)$data['liczba_osi_id']) {
                foreach ($images as $image) {
                    if ($robot->id == $image->robot_id)
                        $image->delete();
                }
                $robot->delete();
            }
        }
        $osie = \App\osie::where('id', $request->query('id', $data))->delete();
        return redirect()->back();
    }

    function deleteProducent(Request $request): RedirectResponse {
        $data = request()->validate([
            'producent_id'=>'required'
        ]);
        $robots = \App\robot::all();
        $images = \App\image::all();

        foreach ($robots as $robot){
            if($robot->producent_id == (int)$data['producent_id']) {
                foreach ($images as $image) {
                    if ($robot->id == $image->robot_id)
                        $image->delete();
                }
                $robot->delete();
            }
        }
        $producent = \App\producent::where('id', $request->query('id', $data))->delete();
        return redirect()->back();
    }

    function deleteStanowisko(Request $request): RedirectResponse {
        $data = request()->validate([
            'stanowisko_id'=>'required'
        ]);
        $robots = \App\robot::all();
        $images = \App\image::all();

        foreach ($robots as $robot){
            if($robot->stanowisko_id == (int)$data['stanowisko_id']) {
                foreach ($images as $image) {
                    if ($robot->id == $image->robot_id)
                        $image->delete();
                }
                $robot->delete();
            }
        }
        $stanowisko = \App\stanowisko::where('id', $request->query('id', $data))->delete();
        return redirect()->back();
    }

    function deleteKontroler(Request $request): RedirectResponse {
        $data = request()->validate([
            'kontroler_id'=>'required'
        ]);
        $robots = \App\robot::all();
        $images = \App\image::all();

        foreach ($robots as $robot){
            if($robot->kontroler_id == (int)$data['kontroler_id']) {
                foreach ($images as $image) {
                    if ($robot->id == $image->robot_id)
                        $image->delete();
                }
                $robot->delete();
            }
        }
        $kontroler = \App\kontroler::where('id', $request->query('id', $data))->delete();
        return redirect()->back();
    }

    function deleteStan(Request $request): RedirectResponse {
        $data = request()->validate([
            'stan_techniczny_id'=>'required'
        ]);
        $robots = \App\robot::all();
        $images = \App\image::all();

        foreach ($robots as $robot){
            if($robot->stan_techniczny_id == (int)$data['stan_techniczny_id']) {
                foreach ($images as $image) {
                    if ($robot->id == $image->robot_id)
                        $image->delete();
                }
                $robot->delete();
            }
        }
        $stan_techniczny = \App\stan_techniczny::where('id', $request->query('id', $data))->delete();
        return redirect()->back();
    }
}
