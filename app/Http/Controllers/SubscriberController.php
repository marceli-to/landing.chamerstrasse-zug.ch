<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Mail\ConfirmationSubscriber;
use App\Mail\ConfirmationOwner;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
  protected $subscriber;

  public function __construct(Subscriber $subscriber)
  {
    $this->subscriber = $subscriber;
  }

  /**
   * Store the data & send the mails
   * 
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */  
  public function store(Request $request)
  {
    // validate request
    $validatedData = $request->validate([
      'firstname' => 'required',
      'name'      => 'required',
      'phone'      => 'required',
      'email'     => 'required|email',
      'privacy'   => 'required',
      //'interest'  => 'required|min:1'
    ]);

    // store the data
    $subscriber = new Subscriber;
    $subscriber->firstname  = $request->firstname;
    $subscriber->name       = $request->name;
    $subscriber->email      = $request->email;
    $subscriber->phone      = $request->phone;
    $subscriber->interest   = $request->interest ? implode(', ' , $request->interest) : NULL;
    $subscriber->save();

    // send mail to client
    try {
      Mail::to($subscriber->email)->send(new ConfirmationSubscriber($subscriber));
    }
    catch(\Throwable $e) {
      \Log::error($e);
    }

    // redirect status
    return redirect()->route('page_landing', ['state' => 'sent']);
  }

}
