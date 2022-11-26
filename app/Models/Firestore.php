<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Firestore\DocumentReference;
use Google\Cloud\Firestore\CollectionReference;

class Firestore extends Model
{
  private FirestoreClient $firestore;
  private string $collectionName;
  private string $documentName;

  public function __construct()
  {
    $this->firestore = new FirestoreClient([
      "keyFilePath" =>
        "C:\Users\idris\Downloads\laravel\concoff\app\Keys\concoff-e1825-15fac59a66e1.json",
      "projectId" => "concoff-e1825",
    ]);
  }

  public function setCollectionName(string $name): Firestore
  {
    $this->collectionName = $name;
    return $this;
  }

  public function setDocumentName(string $name): Firestore
  {
    !empty($this->collectionName) || die("Please provide collection name");

    $this->documentName = $name;
    return $this;
  }

  public function getDocument(): DocumentReference
  {
    !empty($this->documentName) || die("Please provide document name");

    $collection = $this->firestore->collection($this->collectionName);

    if (!$collection->documents()->isEmpty()) {
      return $collection->document($this->documentName);
    }
    return null;
  }

  public function getData(string $key = "")
  {
    if (!empty($key)) {
      return $this->getDocument()
        ->snapshot()
        ->get($key);
    } else {
      return $this->getDocument()
        ->snapshot()
        ->data();
    }
  }

  public function newDocument(array $data): string
  {
    !empty($this->collectionName) || die("Please provide document name");

    return $this->firestore
      ->collection($this->collectionName)
      ->add($data)
      ->id();
  }

  public function deleteDocument(string $name): array
  {
    !empty($this->collectionName) || die("Please provide document name");

    return $this->firestore
      ->collection($this->collectionName)
      ->document($name)
      ->delete();
  }

  public function updateDocument(string $key, $value)
  {
    !empty($this->collectionName) || die("Please provide document name");

    return $this->firestore
      ->collection($this->collectionName)
      ->document($this->documentName)
      ->update(
        [
          [
            "path" => $key,
            "value" => $value,
          ],
        ],
        [
          "merge" => true,
        ]
      );
  }

  //   use HasFactory;
}
