<?php

namespace App\Http\Controllers\PetOwner;

use App\Http\Controllers\Controller;
use App\Models\OnlineConsultation;
use App\Models\Veterinarian;
use Illuminate\Http\Request;

class OnlineConsultationController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      $veterinarians = Veterinarian::with('user', 'petType', 'attachment')->get();

      return view('app.pet-owner.online-consultation.index', compact('veterinarians'));
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      //
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      //
   }

   /**
    * Display the specified resource.
    */
   public function show(OnlineConsultation $onlineConsultation)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(OnlineConsultation $onlineConsultation)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, OnlineConsultation $onlineConsultation)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(OnlineConsultation $onlineConsultation)
   {
      //
   }
}
