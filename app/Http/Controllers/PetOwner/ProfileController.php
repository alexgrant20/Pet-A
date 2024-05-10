<?php

namespace App\Http\Controllers\PetOwner;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetOwner\UpdateProfileRequest;
use App\Models\PetOwner;
use App\Models\Province;
use App\Utilities\FieldAttachmentUploadUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
  private $fieldAttachmentUploadUtility;

  public function __construct(FieldAttachmentUploadUtility $fieldAttachmentUploadUtility)
  {
    $this->fieldAttachmentUploadUtility = $fieldAttachmentUploadUtility;
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = auth()->user();
    $provinces = Province::all();

    return view('app.pet-owner.profile.index', compact('user', 'provinces'));
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
  public function show(PetOwner $petOwner)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(PetOwner $petOwner)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateProfileRequest $request, PetOwner $petOwner)
  {
    try {
      DB::beginTransaction();

      $petOwner->update($request->validated());

      if ($request->profile_image) {
        $this->fieldAttachmentUploadUtility
          ->setRefTable($petOwner::class)
          ->setRefId($petOwner->id)
          ->setFolder('profile_image')
          ->setFieldName('profile_image')
          ->uploadFile($request);
      }
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with('error-swal', 'Something Went Wrong!');
    }

    DB::commit();
    return back()->with('success-swal', 'Profile Successfully Updated!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(PetOwner $petOwner)
  {
    //
  }
}
