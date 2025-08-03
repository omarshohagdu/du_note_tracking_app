<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class NoteTrackingMeta extends Model
{
    protected $table = 'note_tracking_metas';
    public const STATUS_ACTIVE = 1;


    protected $fillable = [
        'type',
        'title',
        'reference_no',
        'current_status',
        'is_active',
        'created_by',
        'created_ip',
        'updated_by',
        'updated_ip',
    ];

    public function content() {
        return $this->hasOne(NoteTrackingContent::class, 'note_meta_id');
    }

    public function latestMovement() {
        return $this->hasOne(NoteTrackingMovement::class, 'note_meta_id')
            ->latestOfMany(); // Laravel 8+
    }
    public function movementHistory() {
        return $this->hasMany(NoteTrackingMovement::class, 'note_meta_id')
            ->orderBy('created_at', 'asc'); // or 'desc' if needed
    }

    public static function fetchEmployeeById($employeeId)
    {
        $url            = 'https://ssl.du.ac.bd/api/';
        $secretKey      = '4a4cfb4a97000af785115cc9b53c313111e51d9a';
        $accessToken    = session('api_token');

        $response = Http::withHeaders([
            'secret-key'    => $secretKey,
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post($url . 'searchEmployeeById', [
            'employee_id' => $employeeId,
        ]);

        if ($response->failed()) {
            return null;
        }

        return $response->json()['data'] ?? null;
    }
    public static function getNotesStatusCountByUser($currentStatus)
    {
        return static::
        with([
            'latestMovement'
        ])
            ->whereHas('latestMovement', function ($query) use ($currentStatus) {
                $query->where('is_active', 1);
                if ($currentStatus == 3) {
                    $query->whereRaw('JSON_EXTRACT(receive_user, "$.employee_id") = ?', [session('user')['user_id']]);
                }else{
                    $query->whereRaw('JSON_EXTRACT(from_user, "$.employee_id") = ?', [session('user')['user_id']]);
                }
            })
            ->where('is_active', static::STATUS_ACTIVE)
            ->where('current_status', $currentStatus)
            ->count();
    }
    public static function getActiveNotesCountByUser(int $userId,$currentStatus)
    {
        return static::where('is_active', static::STATUS_ACTIVE)
            ->where('current_status', $currentStatus)
            ->where('created_by', $userId)
            ->count();
    }



}
