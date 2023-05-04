<?php

namespace App\Http\Controllers\Backend;

use App\Models\Client;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Mail\NotificationEmail;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{

    public function sendSMS(Request $request)
    {
        $json = array(
            "body" => "Your one time pass is 4567. Please, don\'t disclose this to anyone.",
            "from" => "AirtimeNG",
            "to" => "2348090659632",
            "api_token" => config('app.sms'),
            "gateway" => "direct-refund"
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.bulksmsnigeria.com/api/v2/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "".json_encode($json),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function sendInvoiceEmail()
    {
        $client = Client::find(5);
        $booking = Booking::find(18);
        $subtotal = 0;
        for($i = 0; $i < count($booking->places); $i++) {
            $subtotal += $booking->places[$i]->price;
        };
        return view('emails.verification', compact("client", "booking", "subtotal"));
    }

    public function sendVerificationEmail($token, $user)
    {
        $mail = $this->configureMailer();
        try {
            $mail->Subject = "Verification Message from Travellers";
            $mail->Body = view('emails.verification', compact("token"))->render();
            $mail->setFrom(config('app.mail_username'), 'Traveller');
            $mail->addAddress($user->email);

            $mail->send();
        }
        catch(e){
            return back()->with('error','Message could not be sent.');
        }
    }

    public function sendClientVerificationEmail($token, $user)
    {
        $mail = $this->configureMailer();
        try {
            $mail->Subject = "Verification Message from Travellers";
            $mail->Body = view('emails.client.verification', compact("token"))->render();
            $mail->setFrom(config('app.mail_username'), 'Traveller');
            $mail->addAddress($user->email);

            $mail->send();
        }
        catch(e){
            return back()->with('error','Message could not be sent.');
        }
    }

    public function configureMailer()
    {
        $mail = new PHPMailer(true);

        // Email server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';             //smtp host
        $mail->SMTPAuth = true;
        $mail->Username = config('app.mail_username');   //sender username
        $mail->Password = config('app.mail_password');       //sender password
        $mail->SMTPSecure = 'ssl';                  //encryption - ssl/tls
        $mail->Port = 465;
        $mail->isHTML(true);

        return $mail;
    }

    // public function sendEmail(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'message' => 'required',
    //         'subject' => 'required',
    //         'email' => 'required',
    //     ]);

    //     $mail = new PHPMailer(true);
    //     try {
    //         // Email server settings
    //         $mail->SMTPDebug = 0;
    //         $mail->isSMTP();
    //         $mail->Host = 'smtp.gmail.com';             //  smtp host
    //         $mail->SMTPAuth = true;
    //         $mail->Username = config('app.mail_username');   //  sender username
    //         $mail->Password = config('app.mail_password');       // sender password
    //         $mail->SMTPSecure = 'ssl';                  // encryption - ssl/tls
    //         $mail->Port = 465;                          // port - 587/465

    //         $mail->setFrom('victornkpubre@gmail.com', 'Traveller');
    //         $mail->addAddress('fingerfoodappdevelopment@gmail.com');
    //         $mail->isHTML(true);

    //         $mail->Subject = "Message from Travellers";
    //         $mail->Body = view('emails.notification')->render();

    //         if($mail->send()) {
    //             return back()->with('success','Message sent.');
    //         }
    //         else {
    //             return back()->with('error','Message could not be sent.');
    //         }
    //     }
    //     catch(e){
    //         return back()->with('error','Message could not be sent.');
    //     }



    // }




}
