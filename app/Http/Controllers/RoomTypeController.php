<?php

namespace App\Http\Controllers;

use App\Models\ReservationType;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomTypeImage;
use App\Models\RoomTypePrice;
use App\Models\UploadFile;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::orderBy('order')->get();
        return view('dashboard.pages.room-type.index', compact('roomTypes'));
    }

    public function create()
    {
        $reservationTypes = ReservationType::orderBy('order')->get();
        return view('dashboard.pages.room-type.create', compact('reservationTypes'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'facilities' => 'required',
            'order' => 'required',
            'images' => 'required'
        ];

        foreach (ReservationType::all() as $reservationType) {
            $rules['room-type-' . $reservationType->name] = 'required';
        }

        $validatedData = $request->validate($rules);

        DB::transaction(function () use ($validatedData) {
            $roomTypeId = RoomType::create([
                'name'              => $validatedData['name'],
                'facilities'        => $validatedData['facilities'],
                'order'        => $validatedData['order'],
            ])->id;

            foreach ($validatedData['images'] as $image) {
                $uploadFile = UploadFile::where('filename', $image)->first();
                $file = new File(Storage::path($image));
                $newFilename = now()->timestamp . '-' . Str::random(20) . '.' . $file->getExtension();
                $fileLocation = Storage::putFileAs(
                    'public/room_type',
                    $file,
                    $newFilename
                );
                RoomTypeImage::create([
                    'room_type_id'      => $roomTypeId,
                    'filename'          => 'room_type/' . $newFilename,
                    'filename_original' => $uploadFile->filename_original
                ]);
                $uploadFile->delete();
            }

            foreach (ReservationType::all() as $reservationType) {
                RoomTypePrice::create([
                    'room_type_id'          => $roomTypeId,
                    'reservation_type_id'   => $reservationType->id,
                    'price'                 => $validatedData['room-type-' . $reservationType->name]
                ]);
            }
        });

        return redirect('/room-types')->with('success', 'Berhasil menambah data tipe kamar!');
    }

    public function show(RoomType $roomType)
    {
        //
    }

    public function edit(RoomType $roomType)
    {
        foreach ($roomType->images as $index => $roomTypeImage) {
            $roomType->images[$index]->filename = asset('storage/' . $roomTypeImage->filename);
        }

        $reservationTypes = ReservationType::orderBy('order')->get();
        return view('dashboard.pages.room-type.edit', compact('roomType', 'reservationTypes'));
    }

    public function update(Request $request, RoomType $roomType)
    {
        $rules = [
            'name' => 'required',
            'facilities' => 'required',
            'order' => 'required',
            'images' => 'required'
        ];
        
        foreach (ReservationType::all() as $reservationType) {
            $rules['room-type-' . $reservationType->name] = 'required';
        }
        
        $validatedData = $request->validate($rules);

        DB::transaction(function () use ($validatedData, $roomType) {
            RoomType::where('id', $roomType->id)->update([
                'name'         => $validatedData['name'],
                'facilities'   => $validatedData['facilities'],
                'order'        => $validatedData['order'],
            ]);


            foreach (RoomTypeImage::where('room_type_id', $roomType->id)->get() as $roomTypeImage) {
                $isDelete = true;
                foreach ($validatedData['images'] as $image) {
                    if (strpos($image, $roomTypeImage->filename))
                        $isDelete = false;
                }
                if ($isDelete)
                    $roomTypeImage->delete();
            }

            foreach ($validatedData['images'] as $image) {
                $uploadFile = UploadFile::where('filename', $image)->first();
                if ($uploadFile) {
                    $file = new File(Storage::path($image));
                    $newFilename = now()->timestamp . '-' . Str::random(20) . '.' . $file->getExtension();
                    $fileLocation = Storage::putFileAs(
                        'public/room_type',
                        $file,
                        $newFilename
                    );
                    RoomTypeImage::create([
                        'room_type_id'      => $roomType->id,
                        'filename'          => 'room_type/' . $newFilename,
                        'filename_original' => $uploadFile->filename_original
                    ]);
                    $uploadFile->delete();
                }
            }

            foreach (ReservationType::all() as $reservationType) {
                RoomTypePrice::where('room_type_id', $roomType->id)
                    ->where('reservation_type_id', $reservationType->id)
                    ->update([
                        'price' => $validatedData['room-type-' . $reservationType->name]
                    ]);
            }
        });

        return redirect('/room-types')->with('success', 'Berhasil memperbaharui data tipe kamar!');
    }
    
    public function destroy(RoomType $roomType)
    {
        Room::where('room_type_id', $roomType->id)->delete();
        RoomType::destroy($roomType->id);
        
        return redirect('/room-types')->with('success', 'Berhasil menghapus data tipe kamar!');
    }
}
