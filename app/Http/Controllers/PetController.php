<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetOwner\StorePetRequest;
use App\Models\Breed;
use App\Models\FieldAttachmentUpload;
use App\Models\Pet;
use App\Models\PetType;
use App\Utilities\FieldAttachmentUploadUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
  private $fieldAttachmentUploadUtility;

  public function __construct(FieldAttachmentUploadUtility $fieldAttachmentUploadUtility)
  {
    $this->fieldAttachmentUploadUtility = $fieldAttachmentUploadUtility;
  }

  public function index()
  {
    $pets = auth()->user()->profile->pet;

    return view('app.pet-owner.pets.index', compact('pets'));
  }

  public function create()
  {
    $petTypes = PetType::all();
    $breeds = Breed::all();

    return view('app.pet-owner.pets.create', compact('petTypes', 'breeds'));
  }

  public function store(StorePetRequest $request)
  {
    $payload = $request->validated();
    $payload['pet_owner_id'] = Auth::user()->profile->id;

    try {
      DB::beginTransaction();

      $pet = Pet::create($payload);

      $this->fieldAttachmentUploadUtility
        ->setRefTable($pet::class)
        ->setRefId($pet->id)
        ->setFolder('pet_image')
        ->setFieldName('pet_image')
        ->uploadFile($request);
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with('error-swal', 'Something Went Wrong!');
    }

    DB::commit();

    return to_route('pet-owner.index')->with('success-toast', 'Pet Successfully Created');
  }

  public function show($petId)
  {
    $pet = Pet::where([
      ['id', $petId],
      ['pet_owner_id', auth()->user()->profile->id]
    ])->firstOrFail();

    return view('app.pet-owner.pets.show', compact('pet'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
