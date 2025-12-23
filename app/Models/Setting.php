<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**
     * Get setting value by key
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $setting = Cache::remember("setting.{$key}", 3600, function () use ($key) {
            return self::where('key', $key)->first();
        });

        return $setting ? $setting->value : $default;
    }

    /**
     * Set setting value
     * 
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        $setting = self::firstOrCreate(['key' => $key]);
        $setting->value = $value;
        $setting->save();

        Cache::forget("setting.{$key}");
    }

    /**
     * Get all settings as array
     * 
     * @return array
     */
    public static function getAll()
    {
        return Cache::remember('settings.all', 3600, function () {
            return self::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Clear settings cache
     * 
     * @return void
     */
    public static function clearCache()
    {
        Cache::forget('settings.all');
        
        $keys = ['hero_image', 'company_name', 'company_tagline', 'company_description', 
                 'company_phone', 'company_email', 'company_address'];
        
        foreach ($keys as $key) {
            Cache::forget("setting.{$key}");
        }
    }
}