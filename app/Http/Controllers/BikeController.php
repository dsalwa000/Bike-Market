<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use ZipArchive;

use App\Mail\mailConfirm;
use App\Mail\mailGeneral;
use App\Mail\mailBike;
use App\Mail\mailBuyback;

use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


// use Illuminate\Support\Facades\Artisan;

class BikeController extends Controller {

    function showRowerPathFunction() {
        return "/showRower/";
    }

    // General sub-pages
    function index() {
        $show_rower_path = $this->showRowerPathFunction();
        if (Auth::user()) {
            if (Auth::user()->hasRole('user')) {
                return redirect('/user');
            } elseif (Auth::user()->hasRole('superadministrator')) {
                return redirect('/admin');
            }
        } else {
            $bikes = \App\bike::all();
            $images = \App\image::all();
            $localisation = \App\localisation::all();
            $producent = \App\producent::all();
            $purpose = \App\purpose::all();
            $condition = \App\condition::all();

            $howManyBikes = 0;

            return view('pages.offer', compact('howManyBikes', 'bikes', 'images', 'localisation', 'producent', 'purpose', 'condition'));
        }
    }

    function results(Request $request) {
        $show_rower_path = $this->showRowerPathFunction();

        $bikes = \App\bike::all();
        $images = \App\image::all();
        $localisation = \App\localisation::all();
        $producent = \App\producent::all();
        $purpose = \App\purpose::all();
        $condition = \App\condition::all();


        $data = request()->validate([
            'purpose' => 'required',
            'producent' => 'required',
            'localisation' => 'required',
            'condition' => 'required',
            'slider-1' => 'required',
            'slider-2' => 'required',
            'slider-3' => 'required',
            'slider-4' => 'required',
        ]);

        $purposeSearcher = $data['purpose'];
        $producentSearcher = $data['producent'];
        $localisationSearcher = $data['localisation'];
        $conditionSearcher = $data['condition'];
        $yearMin = $data['slider-1'];
        $yearMax = $data['slider-2'];
        $priceMin = $data['slider-3'];
        $priceMax = $data['slider-4'];


        $initializationArray = [];
        foreach ($bikes as $bike) {
            $initializationArray[] = $bike;
        }

        $purposeResult = [];
        if ($purposeSearcher == 'All') {
            $purposeResult = $initializationArray;
        } else {
            foreach ($initializationArray as $bike) {
                if ($purpose[$bike->purposes - 1]->value == $purposeSearcher) {
                    $purposeResult[] = $bike;
                }
            }
        }

        $localisationResult = [];
        if ($localisationSearcher == 'All') {
            $localisationResult = $purposeResult;
        } else {
            foreach ($purposeResult as $bike) {
                if ($localisation[$bike->localisation - 1]->value == $localisationSearcher) {
                    $localisationResult[] = $bike;
                }
            }
        }

        $producentResult = [];
        if ($producentSearcher == 'All') {
            $producentResult = $localisationResult;
        } else {
            foreach ($localisationResult as $bike) {
                if ($producent[$bike->producent - 1]->value == $producentSearcher) {
                    $producentResult[] = $bike;
                }
            }
        }


        $conditionResult = [];
        foreach ($producentResult as $bike) {
            if ($condition[$bike->conditions - 1]->value == $conditionSearcher) {
                $conditionResult[] = $bike;
            }
        }


        $yearResult = [];
        if ($conditionResult != null) {
            foreach ($conditionResult as $bike) {
                if ($yearMin <= $bike->year && $bike->year <= $yearMax) {
                    $yearResult[] = $bike;
                }
            }
        } else {
            $yearResult = $conditionResult;
        }


        $finalResult = [];
        if ($yearResult != null) {
            foreach ($yearResult as $bike) {
                if ($priceMin <= $bike->price && $bike->price <= $priceMax) {
                    $finalResult[] = $bike;
                }
            }
        } else {
            $finalResult = $yearResult;
        }

        $howManyBikes = 0;
        $widthHeight = array();
        foreach ($bikes as $r) {
            foreach ($images as $image) {
                if ($r->id == $image->image) {
                    $howManyBikes++;
                    array_push($widthHeight, getimagesize('images/' . $image->image));
                    break;
                }
            }
        }

        return view('pages.results', compact('bikes', 'images', 'localisation', 'producent', 'purpose', 'condition', 'finalResult', 'producentSearcher', 'localisationSearcher', 'conditionSearcher', 'yearMin', 'yearMax', 'priceMin', 'priceMax', 'finalResult', 'howManyBikes', 'widthHeight'));
    }

    function aboutUs() {
        $show_rower_path = $this->showRowerPathFunction();
        $bikes = \App\bike::all();
        $images = \App\image::all();
        $localisation = \App\localisation::all();
        $producent = \App\producent::all();
        $purpose = \App\purpose::all();
        $condition = \App\condition::all();

        return view('pages.aboutUs', compact('bikes', 'images', 'localisation', 'producent', 'purpose', 'condition'));
    }

    function buyback() {
        $show_rower_path = $this->showRowerPathFunction();
        $bikes = \App\bike::all();
        $images = \App\image::all();
        $localisation = \App\localisation::all();
        $producent = \App\producent::all();
        $purpose = \App\purpose::all();
        $condition = \App\condition::all();

        return view('pages.buyback', compact('bikes', 'images', 'localisation', 'producent', 'purpose', 'condition'));
    }

    function ourShop() {
        $bikes = \App\bike::all();
        $images = \App\image::all();
        $localisation = \App\localisation::all();
        $producent = \App\producent::all();
        $purpose = \App\purpose::all();
        $condition = \App\condition::all();

        return view('pages.ourShop', compact('bikes', 'images', 'localisation', 'producent', 'purpose', 'condition'));
    }

    function showBike($bike, Request $request) {
        // $show_rower_path = $this->showRowerPathFunction();
        $bikes = \App\bike::all();
        $images = \App\image::all();

        $thisBike = \App\bike::where('id', $request->query('id', $bike))->get();

        $thisProducent = \App\producent::where('id', $request->query('id', $thisBike[0]->producent))->get();
        $thisLocalisation = \App\localisation::where('id', $request->query('id', $thisBike[0]->localisation))->get();
        $thisCondition = \App\condition::where('id', $request->query('id', $thisBike[0]->conditions))->get();
        $thisPurpose = \App\purpose::where('id', $request->query('id', $thisBike[0]->purposes))->get();

        $bikeImages = \App\image::where('bike', $request->query('bike', $thisBike[0]->id))->get();

        $dimentions = array();
        foreach ($bikes as $r) {
            foreach ($images as $image) {
                if ($r->id == $image->image) {
                    array_push($wymiary, getimagesize('images/' . $image->image));
                    break;
                }
            }
        }

        return view('pages.bike', compact(
            'bike',
            'bikes',
            'images',
            'thisBike',
            'thisProducent',
            'thisLocalisation',
            'thisCondition',
            'thisPurpose',
            'bikeImages',
            'dimentions',
        ));
    }

    
    // Mails
    function createConfirmationMail($data) {
        $code = rand(1000, 9999);
        $codeEncrypted = Crypt::encrypt($code);
        try {
            Mail::to($data['email'])->send(new mailConfirm($code));
        }
        catch(Exception $e) {
            return view('form.formRejacted');
        }
        return $codeEncrypted;
    }

    // General form
    function sendConfirmationCodeGeneral(Request $request) {
        $data = $request->validate([
            'nameSurname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        $codeEncrypted = $this->createConfirmationMail($data);

        Session::put('sendForm', true);

        return view('form.confirmGeneralForm', compact('data', 'codeEncrypted'));
    }

    function sendFormGeneral(Request $request) {
        $sendForm = Session::get('sendForm');
        if ($sendForm === true) {
            $data = $request->validate([
                'nameSurname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'message' => 'required',
                'confirmationCode' => 'required',
                'codeEncrypted' => 'required'
            ]);

            $codeDecrypted = Crypt::decrypt($data['codeEncrypted']);

            if ($data['confirmationCode'] == $codeDecrypted) {
                Mail::to($data['email'])->send(new mailGeneral($data, true));
                Mail::to('bike_market@udamian.webd.pro')->send(new mailGeneral($data, false));
                Session::put('sendForm', false);
                return view('form.formSent');
            } else {
                $codeEncrypted = $data['codeEncrypted'];
                return view('form.wrongCodeGeneral', compact('data', 'codeEncrypted'));
            }
        } else {
            return view('form.formRejacted');
        }
    }
    

    // Bike form
    function sendConfirmationCodeSingleBike(Request $request, $bikeId) {
        $data = $request->validate([
            'nameSurname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);
        $codeEncrypted = $this->createConfirmationMail($data);

        Session::put('sendForm', true);

        return view('form.confirmBikeForm', compact('data', 'codeEncrypted', 'bikeId'));
    }

    function sendFormSingleBike(Request $request) {
        $sendForm = Session::get('sendForm');

        if ($sendForm === true) {
            $data = $request->validate([
                'nameSurname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'message' => 'required',
                'bikeId' => 'required',
                'confirmationCode' => 'required',
                'codeEncrypted' => 'required'
            ]);

            $codeDecrypted = Crypt::decrypt($data['codeEncrypted']);
            $bikeId = $data['bikeId'];

            if ($data['confirmationCode'] == $codeDecrypted) {
                $bike = \App\bike::where('id', $request->query('id', $bikeId))->get();

                Mail::to($data['email'])->send(new mailBike($data, $bike, true));
                Mail::to('bike_market@udamian.webd.pro')->send(new mailBike($data, $bike, false));
                Session::put('sendForm', false);
                return view('form.formSent');
            } else {
                $codeEncrypted = $data['codeEncrypted'];
                return view('form.wrongCodeBike', compact('data', 'codeEncrypted', 'bikeId'));
            }
        } else {
            return view('form.formRejacted');
        }
    }
    

    // Buyback form
    function sendConfirmationCodeBuyback(Request $request) {
        $data = $request->validate([
            'nameSurname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        Session::put('sendForm', true);

        $form = $this->decodeImages64($request->file('sendForm'));

        $bikeImages = [];
        $imagesLimit = 5;
        for ($i=0; $i<$imagesLimit; $i++) {
            try {
                $bikeImages[] = $this->decodeImages64($request->file('bikeImages')[$i]);
            } catch (Exception $e) {
                // 'Undefined offset';
            }
        }

        Session::put('form', $form);
        Session::put('bikeImages', $bikeImages);

        $codeEncrypted = $this->createConfirmationMail($data);

        return view('form.confirmBuybackForm', compact('data', 'form', 'bikeImages', 'codeEncrypted'));
    }

    function decodeImages64($image) {
        $imagePath = $image->getRealPath();
        $imageData = file_get_contents($imagePath);
        $image64 = base64_encode($imageData);
        return $image64;
    }


    function decodeImages($data, $input, $file) {
        $formData = base64_decode($data[$input]);
            
        $fileName = $file;

        Storage::put('buyback-pdf/' . $fileName, $formData);

        return $fileName;
    }

    function sendFormBuyback(Request $request) {
        $sendForm = Session::get('sendForm');
        if ($sendForm === true) {
            $data = $request->validate([
                'nameSurname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'message' => 'required',
                'confirmationCode' => 'required',
                'codeEncrypted' => 'required',
                'formInput' => 'required',
                'bikeImage0' => 'required',
                'bikeImage1' => 'string|nullable',
                'bikeImage2' => 'string|nullable',
                'bikeImage3' => 'string|nullable',
                'bikeImage4' => 'string|nullable',
            ]);

            $codeDecrypted = Crypt::decrypt($data['codeEncrypted']);
            $savedPhotos = [];

            if ($data['confirmationCode'] == $codeDecrypted) {
                $savedPhotos[] = $this->decodeImages($data, 'formInput', 'form.jpg');

                for($i=0; $i<5; $i++) {
                    try {
                        $savedPhotos[] = $this->decodeImages($data, 'bikeImage' . $i, 'bikeImage' . $i . '.jpg');
                    }
                    catch (Exception $e) {
                        // something is wrong I can feel it
                    }
                }

                $zipPath = public_path('buyback-pdf/newBike.zip');
                $zip = new ZipArchive;
                if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                    foreach($savedPhotos as $photo) {
                        $photoPath = Storage::path('buyback-pdf/' . $photo);
                        $zip->addFile($photoPath, $photo);
                    }
                    $zip->close();
                }
                // $zipContents = file_get_contents($tempZipPath);
                // Storage::put('buyback-pdf/newBike.zip' , $zip);

                Mail::to('bike_market@udamian.webd.pro')->send(new mailBuyback($data, false));
                Mail::to($data['email'])->send(new mailBuyback($data, true));

                Session::put('sendForm', false);
                return view('form.formSent');
            } else {
                $form = Session::get('form');
                $bikeImages = Session::get('bikeImages');

                $codeEncrypted = $data['codeEncrypted'];

                return view('form.wrongCodeBuyback', compact('data', 'form', 'bikeImages', 'codeEncrypted'));
            }
        } else {
            return view('form.formRejacted');
        }
    }


    // PDF
    function pdfOffer() {
        $images = \App\image::all();
        $bikes = \App\bike::all();
        $localisation = \App\localisation::all();
        $producent = \App\producent::all();
        $purpose = \App\purpose::all();
        $condition = \App\condition::all();
        $html = View::make('pdf.pdfOffer', compact('bikes', 'images', 'localisation', 'producent', 'purpose', 'condition'));
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('wholeOfferPDF.pdf');
    }

    function pdfSingleBike($bike) {
        $images = \App\image::all();
        $thisBike = \App\bike::where('id', $bike)->first();
        $localisation = \App\localisation::all();
        $producent = \App\producent::all();
        $purpose = \App\purpose::all();
        $condition = \App\condition::all();
        $html = View::make('pdf.pdfBike', compact('thisBike', 'images', 'localisation', 'producent', 'purpose', 'condition'));
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($thisBike->name);
    }
}
