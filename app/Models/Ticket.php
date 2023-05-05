<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = ['medias' => 'array'];

    public function user($type = null)
    {
        return $this->belongsTo(User::class,$type);
    }

    public function acceptButton()
    {
        $result = [];
        $user = auth()->user();

        if ($user->hasThisPermission('supervisor'))
        {
            $result['type']  = 'سرپرست';
            if ($this->supervisor_id)
            {
                if ($this->supervisor_id == $user->id)
                    $result['accept'] = false;
            }
            else
            {
                $result['accept'] = true;
            }
        }

        if ($user->hasThisPermission('ceo'))
        {
            $result['type']  = 'مدیرعامل';
            if ($this->ceo_id)
                $result['accept'] = false;
            else
                $result['accept'] = true;
        }

        return $result;
    }

    public function getStatusAsTextAttribute() : array
    {
        switch ($this->status)
        {
            case "require":
                $text = "فوری";
                break;
            case "normal":
                $text = "معمولی";
                break;
            case "emergency":
                $text = "آنی";
                break;
            default :
                $text = "نام مشخص";
                break;
        }

        return ['text' => $text,'status' => $this->status];
    }

    public function getSenderNameAttribute() : String
    {
        $user = $this->user()->first();
        $name = '';
        if ($user)
            $name = $user->name;

        return $name;
    }
}
