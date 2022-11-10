<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HTransaction extends Model
{
    use HasFactory;

    protected $table = "h_transactions";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "transaction_id",
        "project_id",
        "amount",
        "transaction_method",
        "status",
        "created_at",
        "updated_at"
    ];

    public function project() {
        return $this->belongsTo(Project::class,'project_id','id');
    }
}
