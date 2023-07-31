<?php

namespace App\Observers;

use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ClassroomObserver

{
    // all events in model
    // creating created updating updated   saved save 
    // deleting deleted Restoring Restored ForceDeleteing ForcDeleted
    // Retrieved
    
    /**
     * Handle the Classroom "created" event.
     */
     // يتم تنفيذ هذا الكود عند عملية الإنشاء
    public function creating(Classroom $classroom): void
    {
        $classroom->user_id = Auth::id();
        $classroom->code = Str::random(10);
    }

    /**
     * Handle the Classroom "updated" event.
     */
    public function updated(Classroom $classroom): void
    {
        //
    }

    /**
     * Handle the Classroom "deleted" event.
     */
    public function deleted(Classroom $classroom): void
    {
        if($classroom->isForceDeleting()){
            return;
        }
        
        $classroom->status="archived";
        $classroom->save();
       
    }

    /**
     * Handle the Classroom "restored" event.
     */
    public function restored(Classroom $classroom): void
    {
        $classroom->status="active";
        $classroom->save();
    }

    /**
     * Handle the Classroom "force deleted" event.
     */
    //  يتم تنفيذ هذا الكود بعد عملية الحذف
    public function forceDeleted(Classroom $classroom): void
    {
        unlink(public_path("uploads/" . $classroom->cover_image));
    }
}
