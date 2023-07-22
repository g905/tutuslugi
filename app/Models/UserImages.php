<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Image;

class UserImages extends Model
{
    use HasFactory;

    protected $table = "user_images";
    protected $fillable
        = [
            'user_id',
            'path',
        ];


    //Проверка изображения
    public static function ImageUploadCheck($ImageFile)
    {

        $validator = Validator::make(
            $ImageFile, [
            'file' => 'required|userphotos|mimes:jpg,jpeg,png|max:10240',
        ], $messages = [
            'userphotos' => 'Можно загрузить до 20 фотографий',
            'mimes' => 'Доступные форматы: jpg, gif, png',
            'max'   => 'Максимальны размер фото 10МБ'
        ]
        );

        return $validator;
    }

    public static function ImageUploadString($AdvertId, $Images)
    {
        $Images = explode(',', $Images);
        if ($Images) {
            $filePath = public_path('storage');
            foreach ($Images as $Image) {
                $Image = trim($Image);
                if (!$Image) {
                    continue;
                }
                if (!file_exists($filePath . "/catalog/{$AdvertId}/")) {
                    mkdir($filePath . "/catalog/{$AdvertId}", 0777);
                }
                $FileName = "/catalog/{$AdvertId}/" . md5(time() . '_' . rand(100, 200));
                $urlMainImage = '' . $FileName . ".webp";
                $img = Image::make(file_get_contents($Image));
                $img->resize(
                    500, 500, function ($const) {
                    $const->aspectRatio();
                }
                // )->save($filePath . '' . $FileName . "." . $extension);
                )->save($filePath . '' . $FileName . '.webp', 80, 'webp');

                UserImages::create(
                    [
                        'advert_id' => $AdvertId,
                        'path'      => $urlMainImage

                    ]
                );
            }
        }

    }

    public static function ImageUpload($UserID, $Image)
    {
        $filePath = public_path('storage');
        $FileName = "/users/{$UserID}/" . md5(time() . '_' . rand(100, 200));
        if (!file_exists($filePath . "/users/{$UserID}/")) {
            mkdir($filePath . "/users/{$UserID}", 0777);
        }
        //$extension = $Image->extension();
        $urlMainImage = '' . $FileName . ".jpg";
        $img = Image::make($Image->path());
        $img->resize(
            700, 700, function ($const) {
            $const->aspectRatio();
        }
        )->save($filePath . '' . $FileName . '_big.jpg', 80, 'jpg');
        $img->resize(
            150, 150, function ($const) {
            $const->aspectRatio();
        }
        )->save($filePath . '' . $FileName . '_small.jpg', 80, 'jpg');

        $ImageID = UserImages::create(
            [
                'user_id' => $UserID,
                'path'    => $FileName.'_small.jpg'

            ]
        );

        return array('image_id' => $ImageID->id, 'image_url' =>  $FileName.'_small.jpg');
    }
}
