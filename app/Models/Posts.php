<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Posts extends Model
{
    // private static $blog_post = [
    //     [
    //         'title'     => 'judul1',
    //         'slug'      => 'judul1',
    //         'author'    => 'penulis1',
    //         'body'      => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident eveniet quidem quis aperiam, dicta modi animi distinctio esse repudiandae accusamus, soluta cum ducimus. Vel illum quos neque delectus consequatur? Incidunt voluptas earum, eligendi dolorum in, soluta libero possimus esse veniam fugit vel. Omnis eius odit praesentium nulla vero iure ad, consequatur iste fuga impedit, laborum officiis porro molestias vel laudantium aut quaerat iusto voluptatum dignissimos soluta. Saepe nihil quaerat tenetur, earum aperiam, adipisci ipsam temporibus distinctio accusamus, odit officia qui. Maiores fugit praesentium pariatur sed excepturi eligendi impedit sint consequuntur voluptatum natus, nemo beatae suscipit porro at commodi explicabo libero.'
    //     ], [
    //         'title'     => 'judul2',
    //         'slug'      => 'judul2',
    //         'author'    => 'penulis2',
    //         'body'      => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex rem vitae inventore exercitationem similique et eos amet esse consequuntur consectetur quae ab magnam blanditiis aut, ullam quas ut deleniti alias, pariatur ratione neque. Eius excepturi et explicabo, assumenda eos unde veritatis incidunt hic, iure illum, exercitationem vitae reprehenderit reiciendis nostrum! Voluptates explicabo iure nemo ex non. Est at, quos maxime eveniet aspernatur autem eligendi ipsam a reprehenderit! Officiis at ad dicta sit aperiam voluptas vitae rerum iste, numquam perspiciatis repellendus doloremque, molestiae vel deserunt perferendis quas blanditiis. Molestiae quos, repellat neque voluptates sint ipsa eos iure cumque esse, magnam dolorem, atque rem. Corrupti neque minus distinctio sed obcaecati quia consectetur ex maiores alias cupiditate dolore, at aut vitae accusamus fugiat, deserunt nostrum tenetur sint odit dolorem, illum reiciendis nesciunt? Unde reprehenderit quasi laudantium consequuntur nihil quod maxime facilis nobis reiciendis molestias cumque deleniti quae sit saepe, quia a incidunt iure. Ducimus ea veniam dolor esse facilis sed corporis officiis dolores qui quo neque consequuntur, voluptates nisi quis deserunt deleniti nobis ad cumque est delectus minima aliquam quibusdam perferendis in. Earum, doloribus consequatur ipsa impedit asperiores eveniet molestias nobis! Dolor impedit eius accusantium nobis similique! Dicta vero eligendi deserunt similique explicabo!'
    //     ],
    // ];

    // public static function all()
    // {
    //     return collect(self::$blog_post);
    // }

    // public static function find($slug)
    // {

    //     $blog_post = static::all();


    //     return $blog_post->firstWhere('slug', $slug);
    // }

    use HasFactory, Sluggable;

    // protected $fillable = ['title', 'excerpt', 'body'];
    protected $guarded = ['id'];

    protected $with = ['author', 'category'];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {

            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['author'] ?? false, fn ($query, $author) =>
        $query->whereHas(
            'author',
            fn ($query) =>
            $query->where('username', $author)
        ));
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
