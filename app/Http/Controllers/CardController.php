<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Card;
use DataTables;
use Validator;
use Exception;
use Session;
use Mail;
use DB;


class CardController extends Controller
{

	public function index(Request $request)
    {       
        return view('card.index');
    }

    public function indexJson(Request $request)
    {
        $cards = Card::all();  

        return \DataTables::of($cards)
            ->editColumn('name', function($data) {
                return $data->person_name;
            })
            ->editColumn('designation', function($data) {
                return $data->designation;
            })
            ->editColumn('business_name', function($data) {
                return $data->business_name;
            })
            ->editColumn('whatsapp_number', function($data) {
                return $data->whatsapp_number;
            }) 
            ->editColumn('action', function($data) {
                $html = '';
                $html .= '<a href="'. url('/card/'.$data->slug) .'" class="btn btn-primary margin-r-5" title="View Card"><i class="fa fa-eye"></i></a>';               
                $html .= '<a href="'. url('/card/edit/'.$data->slug) .'" class="btn btn-info margin-r-5" title="Edit Card"><i class="fa fa-edit"></i></a>';
                $html .= '<form onsubmit="return confirm(\'Are you sure want to delete this card ?\');" action="'. url('/card/delete') .'" method="POST" style="display: inline;" >';
                $html .= '<input type="hidden" name="_token" value="'.csrf_token().'">';
                $html .= '<input type="hidden" value="'.$data->id.'" name="id">';
                $html .= '<button type="submit" class="btn btn-danger margin-r-5" title="Delete Card"><i class="fa fa-trash-o"></i></button>';
                $html .= '</form>';               
                return $html;
            })
            ->rawColumns(['name', 'designation', 'business_name','whatsapp_number','action'])
            ->make(true);
    }

    public function create()
    { 
        return view('card.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();      
        $rules = [
            'person_name' => 'required',
            'designation' => 'required',
            'short_description' => 'max:151',          
            'email' => 'required',
            'whatsapp_number' => 'required|numeric'            
        ];

        $attributeNames = array(
            'person_name' => 'Person Name',
            'designation' => 'Designation',
            'whatsapp_number' => 'Whatsapp Number',           
            'email' => 'Email',            
        );

        $validator = Validator::make($data, $rules, [
            'whatsapp_number.required_without' => 'Whatsapp Number field is required.',
        ]);

        $validator->setAttributeNames($attributeNames);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        if(!isset($data['business_name'])){
            $data['business_name'] = NULL;
        }
        if(!isset($data['address'])){
            $data['address'] = NULL;
        }
        if(!isset($data['short_description'])){
            $data['short_description'] = NULL;
        }    
        if (isset(request()->image)) {
            $imageName = request()->image;      
            $image_name=\Storage::disk('public')->put('/', $imageName);
        }
        else{
            $image_name = "";
        }        
        $slug = $this->createSlug($data['person_name']);

        Card::create([
            "person_name" => $data['person_name'],
            "designation" => $data['designation'],
            "business_name" => $data['business_name'],
            "short_description" => $data['short_description'],
            "whatsapp_number" => $data['whatsapp_number'],
            "email" => $data['email'],
            "address" => $data['address'],         
            "photo" => $image_name,         
            "slug" => $slug,         
        ]); 

        Session::flash('message', 'Card created successfully.');
        Session::flash('alert-class', 'bg-success');
        return redirect("/");

    }

    public function edit($slug)
    {

        $card = Card::where('slug', $slug)->first();

        if(empty($card)) {
            Session::flash('message', 'Card not found.');
            Session::flash('alert-class', 'alert-danger');
            return redirect("/");
        }
       
        return view('card.edit',compact('card'));
    }

    public function update(Request $request)
    { 
        $data = $request->all();      
        $rules = [
            'person_name' => 'required',
            'designation' => 'required',
            'short_description' => 'max:151',          
            'email' => 'required',
            'whatsapp_number' => 'required|numeric'            
        ];

        $attributeNames = array(
            'person_name' => 'Person Name',
            'designation' => 'Designation',
            'whatsapp_number' => 'Whatsapp Number',           
            'email' => 'Email',            
        );

        $validator = Validator::make($data, $rules, [
            'whatsapp_number.required_without' => 'Whatsapp Number field is required.',
        ]);

        $validator->setAttributeNames($attributeNames);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(!isset($data['business_name'])){
            $data['business_name'] = NULL;
        }
        if(!isset($data['address'])){
            $data['address'] = NULL;
        }
        if(!isset($data['short_description'])){
            $data['short_description'] = NULL;
        }    
        if (isset(request()->image)) {
            $imageName = request()->image;      
            $image_name=\Storage::disk('public')->put('/', $imageName);
        }
        else{
            $image_name = "";
        }        
        $card = Card::where('id', '=', $data['id'])->first();
        if ($card->slug != $data['slug']) {
         $slug = $this->createSlug($request->slug, $data['id']);
        }else{
           $slug = $data['slug'];
        }        

        $card->update([
            "person_name" => $data['person_name'],
            "designation" => $data['designation'],
            "business_name" => $data['business_name'],
            "short_description" => $data['short_description'],
            "whatsapp_number" => $data['whatsapp_number'],
            "email" => $data['email'],
            "address" => $data['address'],         
            "photo" => $image_name,         
            "slug" => $slug,  
        ]);        

        Session::flash('message', 'Card updated successfully.');
        Session::flash('alert-class', 'bg-success');
        return redirect("/");
    }

    public function view($slug){
        $card = Card::where('slug', $slug)->first();

        if(empty($card)) {
            Session::flash('message', 'Card not found.');
            Session::flash('alert-class', 'alert-danger');
            return redirect("/");
        }      
       
        return view('card.card',compact('card'));
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        if (isset($data['id']))
        {
            $card = Card::where('id', '=', $data['id'])->first();

            if(!empty($card)){
                $card->delete();

                Session::flash('message', 'Card has been deleted successfully.');
                Session::flash('alert-class', 'bg-success');
                return redirect("/");
            }
        }
        Session::flash('message', 'Card has been not deleted successfully.');
        Session::flash('alert-class', 'bg-danger');
        return redirect("/");
    }

    public function createSlug($title, $id = 0)
    {       
        $slug = str_slug($title);
       
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    public function getRelatedSlugs($slug, $id = 0)
    {
        return Card::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}