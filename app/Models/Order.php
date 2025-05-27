public function client()
{
    return $this->belongsTo(Client::class);
}

public function branch()
{
    return $this->belongsTo(Branch::class);
}

public function deliveryPerson()
{
    return $this->belongsTo(Employee::class, 'delivery_person_id');
}

public function pizzas()
{
    return $this->belongsToMany(PizzaSize::class, 'order_pizza')->withPivot('quantity');
}

public function extraIngredients()
{
    return $this->belongsToMany(ExtraIngredient::class, 'order_extra_ingredient')->withPivot('quantity');
}
