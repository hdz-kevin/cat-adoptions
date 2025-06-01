<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\AdoptionRequestStatus;
use App\Models\AdoptionRequest;
use App\Models\Cat;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'is_admin' => true,
        ]);

        $users = User::factory(15)->create();
        $cats = Cat::factory(40)->create();

        // Create betwen 2 and 6 adoption requests for each of the last 10 users
        foreach ($users->take(-10) as $user) {
            $catsForRequests = $cats->random(rand(2, 6));

            foreach ($catsForRequests as $cat) {
                if (! AdoptionRequest::where('user_id', $user->id)->where('cat_id', $cat->id)->exists()) {
                    AdoptionRequest::factory()->create([
                        'user_id' => $user->id,
                        'cat_id' => $cat->id,
                        'status' => AdoptionRequestStatus::PENDING,
                    ]);
                }
            }
        }

        // Aprove adoption requests randomly
        for ($i = 0; $i < $cats->count(); $i+=2) {
            $cat = $cats->get($i);
            $pendingRequests = $cat->adoptionRequests()->where('status', AdoptionRequestStatus::PENDING)->get();

            if ($pendingRequests->count() > 0) {
                $approved = $pendingRequests->random();
                if (! $approved->user->cat) {
                    $approved->update(['status' => AdoptionRequestStatus::APPROVED]);
                    $cat->update([
                        'is_adopted' => true,
                        'adopter_id' => $approved->user_id,
                    ]);
                }
            }
        }
    }
}
