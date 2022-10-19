<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'price',
        'sale',
        'code',
        'category_id',
        'image',
        'description',
        'del_flg'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function insertProduct($request)
    {
        return $this->create([
            'name' => $request->name,
            'price' => $request->price,
            'sale' => $request->sale,
            'code' => $request->code,
            'image' => $request->image,
            'description' => $request->description,
            'del_flg' => 0
        ]);
    }
    public function updateProduct($request)
    {
        return $this->where('id', $request->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'sale' => $request->sale,
            'code' => $request->code,
            'image' => $request->filename,
            'description' => $request->description
        ]);
    }
    /**
     * ゴミ箱に入れる
     */
    public function delelteProduct($request)
    {
        return $this->where('id', $request->id)->update([
            'del_flg' => 1
        ]);
    }
    /**
     * 元に戻す
     */
    public function delelteProductReturn($request)
    {
        return $this->where('id', $request->id)->update([
            'del_flg' => 0
        ]);
    }
    /**
     * 完全に削除
     */
    public function delelteProductComplete($request)
    {
        return $this->where('id', $request->id)->delete();
    }
}