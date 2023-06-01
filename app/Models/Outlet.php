<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    
    /*
    * @var array
    */
   protected $fillable = [
       'name', 'address', 'latitude', 'longitude', 'creator_id',
   ];

   /**
    * The accessors to append to the model's array form.
    *
    * @var array
    */
   public $appends = [
       'coordinate', 'map_popup_content',
   ];

   /**
    * Get outlet name_link attribute.
    *
    * @return string
    */
   public function getNameLinkAttribute()
   {
       $title = __('app.show_detail_title', [
           'name' => $this->name, 'type' => __('outlet.outlet'),
       ]);
       $link = '<a href="'.route('outlets.show', $this).'"';
       $link .= ' title="'.$title.'">';
       $link .= $this->name;
       $link .= '</a>';

       return $link;
   }

   /**
    * Outlet belongs to User model relation.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function creator()
   {
       return $this->belongsTo(User::class);
   }

   /**
    * Get outlet coordinate attribute.
    *
    * @return string|null
    */
   public function getCoordinateAttribute()
   {
       if ($this->latitude && $this->longitude) {
           return $this->latitude.', '.$this->longitude;
       }
   }

   /**
    * Get outlet map_popup_content attribute.
    *
    * @return string
    */
   public function getMapPopupContentAttribute()
   {
       $mapPopupContent = '';
       $mapPopupContent .= '<div class="my-2"><strong>'.__('outlet.name').':</strong><br>'.$this->name_link.'</div>';
       $mapPopupContent .= '<div class="my-2"><strong>'.__('outlet.coordinate').':</strong><br>'.$this->coordinate.'</div>';

       return $mapPopupContent;
   }

   

//    public function toArray()
//    {
//     return [
//         'name' => $this->id,
//         'address' => $this->id,
//         'location' => $this->id,
//         'longitude' => $this->id,
//         'latitude' => $this->id,
//         'coordinate' => $this->name,
//         // Tambahkan atribut lain yang ingin Anda sertakan dalam JSON response
//     ];
//     // return  [
//     //     'name'       => 'Outlet Name',
//     //     'address'    => 'Outlet Address',
//     //     'latitude'   => 'Latitude',
//     //     'longitude'  => 'Longitude',
//     //     'location'   => 'Location',
//     //     'coordinate' => 'Coordinate',
//     // ];
//    }
}
