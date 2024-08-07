<?php

namespace App\Utilities;

use App\Models\Field;
use App\Models\FieldAttachmentUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class FieldAttachmentUploadUtility
{
  private $attachmentType;
  private $attachmentId;
  private $fieldName;
  private $path;
  private $folder;
  private $useBeginTransaction = true;

  public function setFieldName($fieldName)
  {
    $this->fieldName = $fieldName;

    return $this;
  }

  public function setFolder($folder)
  {
    $this->folder = $folder;

    return $this;
  }

  public function setPath($path)
  {
    $this->path = $path;

    return $this;
  }

  public function setAttachmentType($attachmentType)
  {
    $this->attachmentType = $attachmentType;

    return $this;
  }

  public function setAttachmentId($attachmentId)
  {
    $this->attachmentId = $attachmentId;

    return $this;
  }

  public function setRefTable($refTable)
  {
    $this->attachmentType = $refTable;

    return $this;
  }

  public function setRefId($refId)
  {
    $this->attachmentId = $refId;

    return $this;
  }

  public function generateFileName(Request $request)
  {
    $fieldName = $this->fieldName;
    $file = $request->file($fieldName);
    if (is_array($file)) {
      $file = Arr::flatten($file)[0];
    }
    $ext = $file->getClientOriginalExtension();
    $uniqueKey = Str::random(20) . time();
    $generatedFileName = $fieldName . "_" . $uniqueKey . "." . $ext;
    return $generatedFileName;
  }

  public function moveUploadedFile(Request $request, $folder, $fileName)
  {
    $file = $request->file($this->fieldName);
    if (is_array($file)) {
      $file = Arr::flatten($file)[0];
    }

    $file->move(base_path('/storage/app/public' . $folder), $fileName);
  }

  public function createAttachmentUpload($field, $filePath)
  {
    FieldAttachmentUpload::updateOrCreate(
      [
        'field_id' => $field->id,
        'attachment_type' => $this->attachmentType,
        'attachment_id' => $this->attachmentId,
      ],
      [
        'path' => $filePath
      ]
    );
  }

  private function executeUpload(Request $request)
  {
    $fieldName = $this->fieldName;
    if (!$request->hasFile($fieldName)) {
      throw new \Exception("Request must have a file");
    }

    $generatedFileName = $this->generateFileName($request);
    $folder = $this->path . '/' . $this->folder;

    if (!File::isDirectory($folder)) {
      File::makeDirectory($folder, 0755, true, true);
    }
    $filePath = 'storage/' . $this->folder . '/' . $generatedFileName;

    $field = Field::where('name', $fieldName)->firstOrFail();

    $this->createAttachmentUpload($field, $filePath);
    $this->moveUploadedFile($request,  $folder, $generatedFileName);

    return $filePath;
  }

  public function uploadFile(Request $request)
  {
    try {
      if ($this->useBeginTransaction) DB::beginTransaction();

      $this->executeUpload($request);

      if ($this->useBeginTransaction) DB::commit();
      return true;
    } catch (\Exception $e) {
      if ($this->useBeginTransaction) DB::rollback();
      throw $e;
    }
  }
}
