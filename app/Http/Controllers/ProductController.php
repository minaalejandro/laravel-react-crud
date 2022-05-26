<?php

namespace App\Http\Controllers;

use App\Models\VehicleRegistration;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VehicleRegistration::select('id','ownerIdentityNumber','ownerDateOfBirthHijri','ownerDateOfBirthGregorian','sequenceNumber','plateLetterRight','plateLetterMiddle','plateLetterLeft','plateNumber','plateType')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'owneridnum'=>'required',
            'ownerdateofbirthhijri'=>'required',
            'ownerdateofbirthgregorian'=>'required',
            'sequencenumber'=>'required',
            'plateletterright'=>'required',
            'platelettermiddle'=>'required',
            'plateletterleft'=>'required',
            'platenumbr'=>'required',
            'platetype'=>'required'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
            return response()->json([
                'message'=>'Input erro'
            ],500);;
		}
		else{
            try{
                // $client = new Client();
                // $url = "https://wasl.api.elm.sa/api/eRental/v1/vehicles";
                // $params = [
                //     'ownerIdentityNumber' => $request->owneridnum,
                //     'ownerDateOfBirthHijri' => $request->ownerdateofbirthhijri,
                //     'ownerDateOfBirthGregorian' => $request->ownerdateofbirthgregorian,
                //     'sequenceNumber' => $request->sequencenumber,
                //     'plateLetterRight' => $request->plateletterright,
                //     'plateLetterMiddle' => $request->platelettermiddle,
                //     'plateLetterLeft' => $request->plateletterleft,
                //     'plateNumber' => $request->platenumbr, 
                //     'plateType' => $request->platetype,
                // ];
                // $headers = [
                //     // 'api-key' => 'k3Hy5qr73QhXrmHLXhpEh6CQ'
                //     'Content-Type'=> 'application/json',
                //     'client-id'=> '4F43AF3C-0C94-4C8B-8049-BCEBC3747D3B',
                //     'app-id'=> 'b77ea16e',
                //     'app-key'=> '2b94187f6be2657bf400f8e6403f7289'
                // ];
        
                // $response = $client->request('POST', $url, [
                //     'json' => $params,
                //     'headers' => $headers,
                //     'verify'  => false,
                // ]);
        
                // $responseBody = json_decode($response->getBody());
               
    
                VehicleRegistration::create([
                    'ownerIdentityNumber' => $request->owneridnum,
                    'ownerDateOfBirthHijri' => $request->ownerdateofbirthhijri,
                    'ownerDateOfBirthGregorian' => $request->ownerdateofbirthgregorian,
                    'sequenceNumber' => $request->sequencenumber,
                    'plateLetterRight' => $request->plateletterright,
                    'plateLetterMiddle' => $request->platelettermiddle,
                    'plateLetterLeft' => $request->plateletterleft,
                    'plateNumber' => $request->platenumbr,
                    'plateType' => $request->platetype,
                ]);
                   
    
                return response()->json([
                    'message' => "VALID",
                    'sucess'=> true,
                    "resultCode" =>"sucess"
                ]);
                // return view('projects.apiwithkey', compact('responseBody'));
            }catch(\Exception $e){
                \Log::error($e->getMessage());
                return response()->json([
                    'message'=>'INVALID'
                ],500);
            }
        }
        // echo json_encode($request->all()); die;
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleRegistration $product)
    {
        return response()->json([
            'product'=>$product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleRegistration $product)
    {

        try{
            $id = $request->input('id');
            VehicleRegistration::where('id', $id)
                ->update([
                    'ownerIdentityNumber' => $request->owneridnum,
                    'ownerDateOfBirthHijri' => $request->ownerdateofbirthhijri,
                    'ownerDateOfBirthGregorian' => $request->ownerdateofbirthgregorian,
                    'sequenceNumber' => $request->sequencenumber,
                    'plateLetterRight' => $request->plateletterright,
                    'plateLetterMiddle' => $request->platelettermiddle,
                    'plateLetterLeft' => $request->plateletterleft,
                    'plateNumber' => $request->platenumbr,
                    'plateType' => $request->platetype,
                ]
                );

           

            return response()->json([
                'message'=>'Updated Successfully!!'
            ]);

        }catch(\Exception $e){
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while updating!!'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleRegistration $product)
    {
        try {

            // if($product->image){
            //     $exists = Storage::disk('public')->exists("product/image/{$product->image}");
            //     if($exists){
            //         Storage::disk('public')->delete("product/image/{$product->image}");
            //     }
            // }

            $product->delete();

            return response()->json([
                'message'=>'Deleted Successfully!!'
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while deleting a product!!'
            ]);
        }
    }
}