<?php

use Illuminate\Database\Seeder;
use App\Models\ConcernLocation;
use App\Models\ConcernQuality;
use App\Models\ConcernQualityLocation;

class ConcernQualityLocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BEHAVIOR,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_CIRCLING,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BEHAVIOR,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_HEAD_TILT,
        ]);

        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FACE,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_NOSE,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_NECK,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_TAIL,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_LEG_RF,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_LEG_LF,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_LEG_RR,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_LEG_LR,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FOOT_RF,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FOOT_LF,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FOOT_RR,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FOOT_LR,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_CHEST,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_ABDOMEN,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_BACK,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_RUMP,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_HAIR_LOSS,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_HEAD,
        ]);

        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FACE,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_NOSE,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_NECK,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_TAIL,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_LEG_RF,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_LEG_LF,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_LEG_RR,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_LEG_LR,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FOOT_RF,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FOOT_LF,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FOOT_RR,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FOOT_LR,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_CHEST,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_ABDOMEN,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_BACK,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_RUMP,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_BRUISING,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_HEAD,
        ]);

        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FACE,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_NOSE,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_NECK,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_TAIL,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_LEG_RF,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_LEG_LF,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_LEG_RR,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_LEG_LR,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FOOT_RF,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FOOT_LF,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FOOT_RR,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_FOOT_LR,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_CHEST,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_ABDOMEN,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_BACK,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_RUMP,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_WOUND,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_HEAD,
        ]);

        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_EYE,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_L,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_EYE,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_R,
        ]);

        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_EAR,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_L,
        ]);
        ConcernQualityLocation::firstOrCreate([
            'concern_quality_id' => ConcernQuality::CONCERN_QUALITY_EAR,
            'concern_location_id' => ConcernLocation::CONCERN_LOCATION_R,
        ]);
    }
}
