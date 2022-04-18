<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Setting;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mpdf\Mpdf;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request;

        if ($filter->check_in && $filter->guest) {
            $reservations = Reservation::where('check_in', $filter->check_in)->where('guest_name', 'like', "%" . $filter->guest . "%")->paginate(5);
        } elseif ($filter->check_in) {
            $reservations = Reservation::where('check_in', $filter->check_in)->paginate(5);
        } elseif ($filter->guest) {
            $reservations = Reservation::where('guest_name', 'like', "%" . $filter->guest . "%")->paginate(1);
        } else {
            $reservations = Reservation::paginate(5);
        }

        $status = ['process', 'check-in', 'check-out', 'cancel'];

        return view('/pages/admin/reservations/index', compact('filter', 'reservations', 'status'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Data Reservasi gagal diperbarui');
        }

        $reservation = Reservation::find($id);

        $reservation->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data Reservasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        Reservation::find($id)->delete();

        return redirect()->back()->with('success', 'Data Reservasi berhasil dihapus');
    }

    public function print(Request $request, $id)
    {
        $setting = Setting::all()[0];
        $reservation = Reservation::find($id);

        $first_day = new DateTime($reservation->check_in);
        $last_day = new DateTime($reservation->check_out);
        $interval = $first_day->diff($last_day);
        $total_days = $interval->format('%a');

        $total_price = $reservation->room->price * $reservation->total_rooms * $total_days;

        $long_logo = asset('/images/uploads/setting/' . $setting->long_logo);
        $short_logo = asset('/images/uploads/setting/' . $setting->short_logo);

        $el_status = '';

        if ($reservation->status == 'process') {
            $el_status = "<td style='font-weight: bold;padding: 0;padding-bottom: 4px;color: #FEB139;'>PROSES</td>";
        } elseif ($reservation->status == 'check-in') {
            $el_status = "<td style='font-weight: bold;padding: 0;padding-bottom: 4px;color: #008186;'>CHECK-IN</td>";
        } elseif ($reservation->status == 'check-out') {
            $el_status = "<td style='font-weight: bold;padding: 0;padding-bottom: 4px;color: #4D77FF;'>CHECK-OUT</td>";
        } elseif ($reservation->status == 'cancel') {
            $el_status = "<td style='font-weight: bold;padding: 0;padding-bottom: 4px;color: #FC4F4F;'>CANCEL</td>";
        }

        $html = "
                    <html>
                    <head>
                    </head>
                    <body>
                        <img src=" . $long_logo . " style='height: 64px;margin-bottom: 16px;' />
                        <h3 style='position: absolute;right:60px;top:60px;font-family: Arial;background: #d27643;padding: 4px 12px;color: #fcf2dc;'>BUKTI RESERVASI</h3>
                        <p style='position: absolute;right:60px;top:92px;'>Tanggal: " . date_format($reservation->created_at, 'd-m-Y h:m') . "</p>
                        <h3 style='margin-top: 24px;margin-bottom: 12px;'>DETAIL TAMU</h3>
                        <table>
                            <tr> 
                                <td style='width: 120px;padding: 0;padding-bottom: 4px;'>Nama</td>
                                <td style='width: 32px;padding: 0;padding-bottom: 4px;'>:</td>
                                <td style='font-weight: bold;padding: 0;padding-bottom: 4px;'>" . $reservation->guest_name . "</td>
                            </tr>
                            <tr>
                                <td style='width: 120px;padding: 0;padding-bottom: 4px;'>Email</td>
                                <td style='width: 32px;padding: 0;padding-bottom: 4px;'>:</td>
                                <td style='font-weight: bold;padding: 0;padding-bottom: 4px;'>" . $reservation->email . "</td>
                            </tr>
                            <tr>
                                <td style='width: 120px;padding: 0;padding-bottom: 4px;'>No. HP</td>
                                <td style='width: 32px;padding: 0;padding-bottom: 4px;'>:</td>
                                <td style='font-weight: bold;padding: 0;padding-bottom: 4px;'>" . $reservation->phone . "</td>
                            </tr>
                            <tr>
                                <td style='width: 120px;padding: 0;padding-bottom: 4px;'>No. HP</td>
                                <td style='width: 32px;padding: 0;padding-bottom: 4px;'>:</td> "
            .
            $el_status
            .
            " </tr>
                        </table>
                        <h3 style='margin-top: 24px;margin-bottom: 12px;'>DETAIL RESERVASI</h3>
                        <table style='border: 1px solid #000;width: 100%;padding: 8px 16px;'>
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td style='width: 100px;padding: 0;padding-bottom: 4px;'>Nama Hotel</td>
                                            <td style='width: 12px;padding: 0;padding-bottom: 4px;'>:</td>
                                            <td style='padding: 0;padding-bottom: 4px;'>" . $setting->name . "</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 100px;padding: 0;padding-bottom: 4px;'>Alamat</td>
                                            <td style='width: 12px;padding: 0;padding-bottom: 4px;'>:</td>
                                            <td style='padding: 0;padding-bottom: 4px;'>" . $setting->address . "</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 100px;padding: 0;padding-bottom: 4px;'>Telp</td>
                                            <td style='width: 12px;padding: 0;padding-bottom: 4px;'>:</td>
                                            <td style='padding: 0;padding-bottom: 4px;'>" . $setting->phone . "</td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td style='width: 100px;padding: 0;padding-bottom: 4px;'>Tipe Kamar</td>
                                            <td style='width: 12px;padding: 0;padding-bottom: 4px;'>:</td>
                                            <td style='padding: 0;padding-bottom: 4px;'>" . $reservation->room->name . "</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 100px;padding: 0;padding-bottom: 4px;'>Total Kamar</td>
                                            <td style='width: 12px;padding: 0;padding-bottom: 4px;'>:</td>
                                            <td style='padding: 0;padding-bottom: 4px;'>" . $reservation->total_rooms . "</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 100px;padding: 0;padding-bottom: 4px;'>Total Hari</td>
                                            <td style='width: 12px;padding: 0;padding-bottom: 4px;'>:</td>
                                            <td style='padding: 0;padding-bottom: 4px;'>" . $total_days . "</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div style='margin: 8px 0;'></div>
                        <table style='border: 1px solid #000;width: 100%;padding: 8px 16px;'>
                            <tr>
                                <td>
                                    <table width='100%'>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td style='width: 100px;padding: 0;padding-bottom: 4px;'>Check-In</td>
                                                        <td style='width: 12px;padding: 0;padding-bottom: 4px;'>:</td>
                                                        <td style='padding: 0;padding-bottom: 4px;'>" . $reservation->check_in . "</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td style='width: 100px;padding: 0;padding-bottom: 4px;'>Check-Out</td>
                                                        <td style='width: 12px;padding: 0;padding-bottom: 4px;'>:</td>
                                                        <td style='padding: 0;padding-bottom: 4px;'>" . $reservation->check_out . "</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table style='width: 100%;'>
                                        <tr>
                                            <td>* Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh. Donec rutrum congue leo eget malesuada.</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <h3 style='margin-top: 24px;margin-bottom: 12px;'>DETAIL PEMBAYARAN</h3>
                        <table style='border: 1px solid #000;width: 100%;padding: 8px 16px;'>
                            <tr>
                                <td style='width: 280px;text-align: center;'><img src=" . $short_logo . " style='height: 64px;' /></td>
                                <td style='vertical-align: top;'>
                                    <table>
                                        <tr>
                                            <td style='width: 100px;padding: 0;padding-bottom: 4px;'>Harga Kamar</td>
                                            <td style='width: 12px;padding: 0;padding-bottom: 4px;'>:</td>
                                            <td style='padding: 0;padding-bottom: 4px;'>Rp." . $reservation->room->price . "</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 100px;padding: 0;padding-bottom: 4px;'>Total Kamar</td>
                                            <td style='width: 12px;padding: 0;padding-bottom: 4px;'>:</td>
                                            <td style='padding: 0;padding-bottom: 4px;'>" . $reservation->total_rooms . "</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 100px;padding: 0;padding-bottom: 4px;'>Total Hari</td>
                                            <td style='width: 12px;padding: 0;padding-bottom: 4px;'>:</td>
                                            <td style='padding: 0;padding-bottom: 4px;'>" . $total_days . "</td>
                                        </tr>
                                        <tr>
                                            <td style='width: 100px;padding: 0;padding-bottom: 4px;'>Jumlah</td>
                                            <td style='width: 12px;padding: 0;padding-bottom: 4px;'>:</td>
                                            <td style='padding: 0;padding-bottom: 4px;font-size: 24px;font-weight: bold;color: #d27643;'>Rp. " . $total_price . "</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div style='margin: 8px 0;'></div>
                        <table style='border: 1px solid #000;width: 100%;padding: 8px 16px;'>
                            <tr>
                                <td style='width: 100px;padding: 0;padding-bottom: 4px;'><b>Catatan:</b> Mohon menunjukkan Bukti Reservasi ini kepada Petugas Resepsionis atau Reservasi pada saat Check-In.</td>
                            </tr>
                        </table>
                    </body>
                    </html>
                    ";

        $mpdf = new Mpdf();
        $mpdf->showImageErrors = true;
        $mpdf->WriteHTML($html);

        $mpdf->Output('Bukti Reservasi Hotel' . $setting->name . '.pdf', 'I');
        exit;
    }
}
