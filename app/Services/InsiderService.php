<?php


namespace App\Services;

use App\Insider;
use App\InsiderImage;
use App\User;
use http\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class InsiderService
 * @package App\Services
 */
class InsiderService {

    public function store($validatedData, $image_relative_paths, $user_id) {
        DB::beginTransaction();
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'age' => $validatedData['age'],
                'gender' => $validatedData['gender'],
                'created_by' => $user_id
            ]);

            $user->assignRole('Insider');

            $insider = Insider::create([
                'block_no' => $validatedData['block_no'],
                'building_no' => $validatedData['building_no'],
                'user_id' => $user->id,
                'created_by' => $user_id
            ]);

        foreach ($image_relative_paths as $image_relative_path) {
            error_log($image_relative_path);
            InsiderImage::create([
                'insider_id' => $insider->id,
                'image_path' => $image_relative_path,
                'created_by' => $user_id
            ]);
        }
        DB::commit();
    }

    public function getDatatable() {
        return DB::select('SELECT name, email, age, gender, block_no, building_no, i.id FROM users as u, insiders as i WHERE u.id = i.user_id AND i.deleted_at IS NULL');
    }

    public function update($validatedData, $id) {
        try {
            DB::beginTransaction();
                $insider = Insider::findOrFail($id);

                $insider->block_no = $validatedData['block_no'];
                $insider->building_no = $validatedData['building_no'];
                $insider->updated_at = now();
                $insider->save();

                $insider->user->name = $validatedData['name'];
                $insider->user->email = $validatedData['email'];
                $insider->user->age = $validatedData['age'];
                $insider->user->gender = $validatedData['gender'];
                $insider->user->save();
            DB::commit();

            return true;
        } catch(Exception $exception) {
            return false;
        }
    }

    public function delete(int $id) {
        try {
            Insider::destroy($id);
            return true;
        } catch(Exception $e) {
            return false;
        }
    }

    public function getInsiderById(int $id) {
        return Insider::findOrFail($id);
    }

    public function getImagesPath($insider_id) {
        return InsiderImage::where('insider_id', $insider_id)->get();
    }

    public function getInsidersCount() {
        $insiders = Insider::all();
        return $insiders->count();
    }

    public function getTotalInsiderImagesCount() {
        return InsiderImage::all()->count();
    }
}