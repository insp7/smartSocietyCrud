<?php

namespace App\Services;

use App\Criminal;
use App\CriminalImage;
use App\User;
use http\Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CriminalService
 * @package App\Services
 */
class CriminalService {

    public function store($validatedData, $image_relative_paths, $user_id) {
        DB::beginTransaction();
            $user = User::create([
                'name' => $validatedData['name'],
                'age' => $validatedData['age'],
                'gender' => $validatedData['gender'],
                'created_by' => $user_id
            ]);

            $user->assignRole('Criminal');

            $criminal = Criminal::create([
                'user_id' => $user->id,
                'crime_type' => $validatedData['crime_type'],
                'created_by' => $user_id
            ]);

            foreach ($image_relative_paths as $image_relative_path) {
                error_log($image_relative_path);
                CriminalImage::create([
                    'criminal_id' => $criminal->id,
                    'image_path' => $image_relative_path,
                    'created_by' => $user_id
                ]);
            }
        DB::commit();
    }

    public function getDatatable() {
        return DB::select('SELECT c.id, name, crime_type, age, gender FROM users as u, criminals as c WHERE u.id = c.user_id AND c.deleted_at IS NULL');
    }

    public function update($validatedData, $id) {
        try {
            DB::beginTransaction();
                $criminal = Criminal::findOrFail($id);
                $criminal->crime_type = $validatedData['crime_type'];
                $criminal->updated_at = now();
                $criminal->save();

                $criminal->user->name = $validatedData['name'];
                $criminal->user->age = $validatedData['age'];
                $criminal->user->gender = $validatedData['gender'];
                $criminal->user->save();
            DB::commit();

            return true;
        } catch(Exception $exception) {
            return false;
        }
    }

    public function delete(int $id) {
        try {
            Criminal::destroy($id);
            return true;
        } catch(Exception $e) {
            return false;
        }
    }

    public function getCriminalById(int $id) {
        return Criminal::findOrFail($id);
    }

    public function getImagesPath($criminal_id) {
        return CriminalImage::where('criminal_id', $criminal_id)->get();
    }

    public function getCriminalsCount() {
        $criminals = Criminal::all();
        return $criminals->count();
    }

    public function getTotalCriminalImagesCount() {
        return CriminalImage::all()->count();
    }
}