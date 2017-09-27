<?php
namespace app\modules\admin\components;
use Yii;
use yii\base\Model;

class ImageUpload extends Model
{
    public $image;
    public function rules()
    {
       return [
         [['image'],'file', 'extensions' => 'jpg, png, gif']
       ];
    }

    public function uploadFile($file, $currentImg)
    {
        if($this->validate()){
            $this->deleteCurrentImage($currentImg);
            $fileName =  $this->generateFileName($file);
            $file->saveAs($this->getFolder() . $fileName);
            return $fileName;
        }
        return false;
    }
    private function getFolder(){
        return Yii::getAlias('@web') . 'uploads/';
    }
    private function generateFileName($file){
        return strtolower(md5(uniqid($file->baseName)). '.' . $file->extension);
    }
    public function deleteCurrentImage($currentImg)
    {
        if(is_file($this->getFolder() . $currentImg)){
            unlink($this->getFolder() . $currentImg);
            return true;
        }
        return false;
    }
}