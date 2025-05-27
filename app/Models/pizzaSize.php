namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PizzaSize extends Model
{
    protected $table = 'pizza_size';

    protected $fillable = ['pizza_id', 'size', 'price'];

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }
}
