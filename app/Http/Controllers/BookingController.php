<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Book;
use App\Models\Booking;
use App\Models\Forfeit;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::query();

        // Filter by status
        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        // Search by booking code
        if ($request->filled('search_keyword')) {
            $keyword = $request->input('search_keyword');
            $query->where('booking_code', $keyword);
        }

        // Retrieve paginated bookings
        $bookings = $query->paginate(10);

        return view('dashboard.admin.booking.index', [
            'bookings' => $bookings,
            'title' => 'Manajemen Peminjaman'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.booking.create', [
            'title' => 'Manajemen Peminjaman',
            'books' => Book::where('stock', '>', 0)->orderBy('title', 'asc')->get(),
            'users' => User::where('role', 'member')->orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $validatedData = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'user_id' => ['required', 'exists:users,id'],
            'book_at' => ['required', 'date'],
            'status' => ['required', 'in:Dipinjam,Dikembalikan,Dikembalikan Terlambat,Ditolak'],
        ], [
            'book_id.required' => 'Judul buku harus dipilih.',
            'book_id.exists' => 'Judul buku tidak valid.',
            'user_id.required' => 'Nama peminjam harus dipilih.',
            'user_id.exists' => 'Nama peminjam tidak valid.',
            'book_at.required' => 'Tanggal peminjaman harus diisi.',
            'book_at.date' => 'Tanggal peminjaman harus berupa tanggal.',
            'status.required' => 'Status peminjaman harus dipilih.',
            'status.in' => 'Status peminjaman tidak valid.',
        ]);
        // Generate booking code
        $validatedData['booking_code'] = Booking::generateBookingCode(8);
        // Set expired date
        $validatedData['expired_date'] = Carbon::now()->addDays(7);
        // Decrement stock of the booked book
        $book = Book::find($validatedData['book_id']);
        $book->decrement('stock');
        // Create booking record
        Booking::create($validatedData);
        return redirect('/bookings-management')->with('success', 'Data peminjaman berhasil tersimpan!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Booking $bookings_management)
    {
        return view('dashboard.admin.booking.show', [
            'title' => 'Manajemen Peminjaman',
            'booking' => $bookings_management
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $bookings_management)
    {
        return view('dashboard.admin.booking.edit', [
            'title' => 'Manajemen Buku',
            'booking' => $bookings_management,
            'books' => Book::where('stock', '>', 0)->orderBy('title', 'asc')->get(),
            'users' => User::where('role', 'member')->orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $bookings_management)
    {
        $validatedData = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'user_id' => ['required', 'exists:users,id'],
            'book_at' => ['required', 'date'],
            'status' => ['required', 'in:Dipinjam,Dikembalikan,Dikembalikan Terlambat,Ditolak'],
            'return_date' => ['nullable']
        ], [
            'book_id.required' => 'Judul buku harus dipilih.',
            'book_id.exists' => 'Judul buku tidak valid.',
            'user_id.required' => 'Nama peminjam harus dipilih.',
            'user_id.exists' => 'Nama peminjam tidak valid.',
            'book_at.required' => 'Tanggal peminjaman harus diisi.',
            'book_at.date' => 'Tanggal peminjaman harus berupa tanggal.',
            'status.required' => 'Status peminjaman harus dipilih.',
            'status.in' => 'Status peminjaman tidak valid.',
        ]);

        if ($validatedData['status'] === 'Dipinjam') {
            // stock update
            Book::where('id', $bookings_management->book_id)->update([
                'stock' => $bookings_management->book->stock - 1
            ]);
            // create expired date
            $validatedData['expired_date'] = Carbon::now()->addDays(7);
            // notif
            $data['desc'] = 'Buku berhasil kamu pinjam';

        } elseif ($validatedData['status'] === 'Dikembalikan') {
            // Book stock update
            Book::where('id', $bookings_management->book_id)->update([
                'stock' => $bookings_management->book->stock + 1
            ]);
            // get today date
            $validatedData['return_date'] = Carbon::now();

            // check if the return_date is greater than the expired date if true denda == 1
            if ($validatedData['return_date']->gt($bookings_management->expired_date)) {
                // create forfeit
                // $forfeitData = [
                //     'book_id' => $bookings_management->book->id,
                //     'user_id' => $bookings_management->user->id,
                //     'booking_id' => $bookings_management->id,
                //     'cost' => 50000,
                //     'status' => 'Belum Dibayar',
                // ];
                // Forfeit::create($forfeitData);
                $validatedData['isDenda'] = 1;
                // $data['desc'] = 'Buku dikembalikan terlambat denda wkwk';

            } else {
                $validatedData['isDenda'] = 0;
                // $data['desc'] = 'Buku telah dikembalikan tepat waktu';
            }

        } elseif ($validatedData['status'] === 'Ditolak') {
            // $data['desc'] = 'Gaboleh minjem lu awokawok 😂';

        } elseif ($validatedData['status'] === 'Dikembalikan Terlambat') {
            $validatedData['isDenda'] = 1;
            // $data['desc'] = 'Gaboleh minjem lu awokawok 😂';
        }


        // denda
        if ($validatedData['status'] === 'Dikembalikan Terlambat') {
            Booking::where('id', $bookings_management->id)->update([
                'isDenda' => 1
            ]);
        }
        $bookings_management = Booking::where('id', $bookings_management->id)->update($validatedData);
        return redirect('/bookings-management')->with('successEdit', 'Peminjaman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $bookings_management)
    {
        Book::destroy($bookings_management->id);
        return redirect('/bookings-management')->with('successDelete', 'Peminjaman berhasil dihapus!');
    }
    public function exportBookingPDF()
    {
        // $book = Book::where('id', $request->id)->get('id');
        $data['bookings'] = Booking::all();
        // $pdf = Pdf::loadView('pdf.qr', $book);
        // return $pdf->stream();
        $pdf = Pdf::loadView('pdf.booking', $data);
        return $pdf->download('Bookings_Data_Updated_' . Carbon::now() . '.pdf');
    }
    public function exportPDF(Request $request)
    {
        // $book = Book::where('id', $request->id)->get('id');
        $data['booking'] = [
            'id' => $request->id
        ];
        // $pdf = Pdf::loadView('pdf.qr', $book);
        // return $pdf->stream();
        $pdf = Pdf::loadView('pdf.qr-booking', $data);
        return $pdf->download('qr-code-booking.pdf');
    }
    public function generateInvoice($id)
    {
        $data['booking'] = Booking::where('id', $id)->get();
        // $booking = Booking::where('id', $id)->get();
        // $data = Booking::where('id', $id)->get();
        $pdf = Pdf::loadView('pdf.invoice', $data);
        return $pdf->download('booking_' . $id . '.pdf');
        // return view('pdf.invoice', [
        //     'booking' => $data['booking']
        // ]);
    }
}
