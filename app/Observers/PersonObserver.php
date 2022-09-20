<?php

namespace App\Observers;

use App\Models\Person;
use Illuminate\Support\Facades\Storage;

class PersonObserver
{
    /**
     * Handle the Person "creating" event.
     *
     * @param  \App\Models\Person  $person
     * @return void
     */
    public function creating(Person $person)
    {
        $person->tenant_id = tenant()->id;
    }

    /**
     * Handle the Person "created" event.
     *
     * @param  \App\Models\Person  $person
     * @return void
     */
    public function created(Person $person)
    {
        //
    }

    /**
     * Handle the Person "updated" event.
     *
     * @param  \App\Models\Person  $person
     * @return void
     */
    public function updated(Person $person)
    {
        //
    }

    // /**
    //  * Handle the Person "deleting" event.
    //  *
    //  * @param  \App\Models\Person  $person
    //  * @return void
    //  */
    // public function deleting(Person $person)
    // {
    //     Storage::delete('public/' . $person->picture);
    // }

    /**
     * Handle the Person "deleted" event.
     *
     * @param  \App\Models\Person  $person
     * @return void
     */
    public function deleted(Person $person)
    {
        Storage::delete('public/' . $person->picture);
    }

    /**
     * Handle the Person "restored" event.
     *
     * @param  \App\Models\Person  $person
     * @return void
     */
    public function restored(Person $person)
    {
        //
    }

    /**
     * Handle the Person "force deleted" event.
     *
     * @param  \App\Models\Person  $person
     * @return void
     */
    public function forceDeleted(Person $person)
    {
        //
    }
}
